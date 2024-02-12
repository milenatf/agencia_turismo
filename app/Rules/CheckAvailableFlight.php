<?php

namespace App\Rules;

use App\Models\Flight;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckAvailableFlight implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $flight = Flight::with(['plane', 'reserves'])->findOrFail($value); // Recupera o voo pelo ID
        $maxPassengersCapacity = $flight->plane->qty_passengers; // Recupera a quantidade máxima de passageiros no avião

        $passengersQuantityOnFlight = $flight->reserves->count();

        if($passengersQuantityOnFlight >= $maxPassengersCapacity) {
            $fail('Esta reserva excede a capacidade total do avião');
        }
    }
}
