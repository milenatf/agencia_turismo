<?php

function formatDateAndtime($value, $format = 'd/m/Y')
{
    return \Carbon\Carbon::parse($value)->format($format);
}

function getInfoAirport($city)
{
    $dataCity = explode('-', $city);
    $idAirport = $dataCity[0];

    $dataCity = explode('/', $dataCity[1]);
    $cityName = $dataCity[0];
    $airportName = $dataCity[1];

    return [
        'id_airport' => $idAirport,
        'name_city' => $cityName,
        'name_airport' => $airportName
    ];
}