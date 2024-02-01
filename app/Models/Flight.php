<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

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
     *  */
    public function getItems($totalPage)
    {
        return $this->with(['origin', 'destination'])->paginate($totalPage);
    }

    public function newFlight(Request $request)
    {
        $data = $request->all();

        $data['airport_origin_id'] = $request->origin;
        $data['airport_destination_id'] = $request->destination;

        // dd($data);

        return $this->create($data);
    }

    public function updateFlight(Request $request)
    {
        $data = $request->all();
        $data['airport_origin_id'] = $request->origin;
        $data['airport_destination_id'] = $request->destination;

        return $this->update($data);
    }

    // public function search($keySearch)
    // {
    //     return $this->where('airport_origin', 'LIKE', "%{$keySearch}%")
    //                 ->get();
    // }

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
