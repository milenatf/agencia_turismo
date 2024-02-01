<?php

function formatDateAndtime($value, $format = 'd/m/Y')
{
    return \Carbon\Carbon::parse($value)->format($format);
}