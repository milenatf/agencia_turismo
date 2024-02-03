<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

    // Cast que garante que os valores no campo is_promotion vai ser true ou false
    protected $casts = [
        'is_promotion' => 'boolean'
    ];

    protected $fillable = [
        'plane_id',
        'airport_origin_id',
        'airport_destination_id',
        'date',
        'time_duration',
        'hour_output',
        'arrival_time',
        'old_price',
        'price',
        'total_plots',
        'is_promotion',
        'image',
        'qts_stops',
        'description'
    ];

    /**
     * Método criado para pegar todos os registros de voos a fim de limpar o controller index
     * deixando-o apenas para enviar os dados entre a model e as views
     *
     */
    public function getItems($totalPage)
    {
        return $this->with(['origin', 'destination'])->paginate($totalPage);
    }

    public function newFlight(Request $request, $fileName = '')
    {
        $data = $request->all();

        // dd($data);

        $data['airport_origin_id'] = $request->origin;
        $data['airport_destination_id'] = $request->destination;
        $data['image'] = $fileName;

        return $this->create($data);
    }

    public function updateFlight(Request $request, $fileName = '')
    {
        $data = $request->all();
        $data['airport_origin_id'] = $request->origin;
        $data['airport_destination_id'] = $request->destination;
        $data['image'] = $fileName;

        // dd($data);

        // dd($this->update($data));

        return $this->update($data);
    }

    public function search($request, $totalPage)
    {
        // dd($request->all());
        $flights = $this->where(function($query) use($request) {
            if($request->code)
                $query->where('id', $request->code);

            if($request->date)
                $query->where('date', $request->date);

            if($request->hour_output)
                $query->where('hour_output', $request->hour_output);

            if($request->airport_origin_id)
                $query->where('airport_origin_id', $request->airport_origin_id);


            if($request->airport_destination_id)
                $query->where('airport_destination_id', $request->airport_destination_id);

            if($request->qts_stops !== null) { // verifica se o valor de qts_stops na requisição ($request) não é nulo.
                /**
                 * Se não foi nulo, a condição deve tratar explicitamente, o caso quando qts_stops é zero.
                 * Essa verificação explícita é necessária devido ao modo como o Laravel trata valores nulos ou vazios em consultas.
                 */
                if ($request->qts_stops == 0) { // S
                    $query->where(function ($subquery) use($request) {
                        $subquery->where('qts_stops', $request->qts_stops);
                    });
                } else {
                    $query->where('qts_stops', $request->qts_stops);
                }
            }
        })->with(['origin', 'destination'])->paginate($totalPage);

        // dd($flights);

        return $flights;

    }

    public function origin()
    {
        /**
         * Método belongsTo() uma vez que um aeroporto pode ter diversos voos
         * e um voo está vinculado apenas a um aeroporto
         *  relação nx1
         *
         * Se a chave estrangeira da tabela airport fosse airport_id na tabela de flights, não seria necessário especificar o segundo parâmetro no método
         * belongsTo(). Automaticamente o Laravel faria isso.
         *
         * Entretanto, como a chave estrangeira da tabela airport está como 'airport_origin_id', faz-se necesserário especificar o segundo parâmetro no método belongsTo().
         */
        return $this->belongsTo(Airport::class, 'airport_origin_id');
    }

    public function destination()
    {
        /**
         * Método belongsTo() uma vez que um aeroporto pode ter diversos voos
         * e um voo está vinculado apenas a um aeroporto
         *  relação nx1
         *
         * Se a chave estrangeira da tabela airport fosse airport_id na tabela de flights, não seria necessário especificar o segundo parâmetro no método
         * belongsTo(). Automaticamente o Laravel faria isso.
         *
         * Entretanto, como a chave estrangeira da tabela airport está como 'airport_origin_id', faz-se necesserário especificar o segundo parâmetro no método belongsTo().
         */
        return $this->belongsTo(Airport::class, 'airport_destination_id');
    }

    /**
     *  Mutator para exibir a data em formato brasileiro
     * Padrão getNomedoAtributoAttribute()
     */
    // public function getDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }
}
