<?php

function formaterPrix($amount) {

    $fmt = new NumberFormatter("fr_FR", NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($amount, "EUR");
}