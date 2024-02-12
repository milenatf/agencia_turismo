<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReserveFormRequest;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Reserve;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $title = 'Home Page';

        $airports = Airport::with('city')->get();

        return view('site.home.index', compact('title', 'airports'));
    }

    public function promotions()
    {
        $title = 'Promoções';

        return view('site.promotions.list', compact('title'));
    }

    public function search(Request $request, Flight $flight)
    {
        $title = 'Resultados da pesquisa';

        $origin = getInfoAirport($request->origin);
        $destination = getInfoAirport($request->destination);

        // dd($origin . ' | ' .$destination);

        $flights = $flight->searchFlights(
                            $origin['id_airport'],
                            $destination['id_airport'],
                            $request->date
                        );

        return view('site.search.search', [
            'title' => $title,
            'flights' => $flights,
            'origin' => $origin['name_city'],
            'destination' => $destination['name_city'],
            'date' => formatDateAndtime($request->date)

        ]);
    }

    public function detailsFlight($idFlight)
    {
        $flight = Flight::with(['origin', 'destination'])->find($idFlight);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        $title = "Detalhes do voo {$flight->id}";

        return view('site.flights.details', compact('title', 'flight'));
    }

    public function reserveFlight(StoreReserveFormRequest $request, Reserve $reserve)
    {
        if( $reserve->newReserve($request->flight_id) )
            return redirect()
                    ->route('purchaces')
                    ->with('success', 'Reserva realizada do sucesso!');

        return redirect()->back()->with('error', 'Não foi possível realizar a reserva');
    }

    public function myPurchaces()
    {
        dd('My Purchaces');
    }
}
