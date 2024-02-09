<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'date_reserved',
        'status'
    ];

    public function status($st = null)
    {
        $statusAvailable = [
            'reserved' => 'Reservado',
            'canceled' => 'Cancelado',
            'paid' => 'Pago',
            'concluded' => 'Concluído'
        ];

        // if($op)
        //     return $statusAvailable['reserved'];

        // return $statusAvailable;

        if (!$st)
            return $statusAvailable;

        return $statusAvailable[$st];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function changeStatus($newStatus) // Faz a alteração do status da reserva
    {
        $this->status = $newStatus;

        return $this->save();
    }

    public function search($request, $totalPage = 10)
    {
        // $this->where(function($query) use ($request) {
        // if($request->date) // Essa data está na tabela de reserva e sim na tabela de voos pois essa é data para ser filtrada. A data do voo
        // Dessa forma é necessário fazer uma combinação para trazer os dados das tabela de usuários, voos e reservas.
        // })->paginate($totalPage);

        // dd($request);

        /*
        "_token" => "g1jrCUb6aDNdknwsAMRSmWfwqpLDsBQPuSYmRNea"
        "user" => "Milena"
        "reserve" => "18"
        "date" => "2024-02-08"
        */

        // Join da tabela de reserva combinando os dados da tabela de usuário e da tabela de voo
        $reserves = $this->join('users', 'users.id', '=', 'reserves.user_id') // Faz um join na tabela users onde o id da da tabela  users é igual ao user_id da tabela reserves.
            ->join('flights', 'flights.id', '=', 'reserves.flight_id') // Faz um join na tabela flights onde o id da da tabela  flights é igual ao flight_id da tabela reserves.
            ->select('reserves.*', 'users.name as user_name', 'users.email as user_email', 'users.id as user_id', 'flights.id as flight_id', 'flights.date as flight_date') // Informa quais colunas da tabela reserves (todas), users(name, email e id) e flights(id e data) serão retornados
            ->where(function ($query) use ($request) {
                if($request->user)
                    $dataUser = $request->user;
                    $query->where(function($subQuery) use ($dataUser) {
                        $subQuery->where('users.name', 'LIKE', "%{$dataUser}%")
                                ->orWhere('users.email', 'LIKE' ,"%{$dataUser}%);
                    });

                if($request->reserve)
                    $query->where('flights.id', $request->reserve);
            })
            ->paginate($totalPage);

        return $reserves;
    }
}
