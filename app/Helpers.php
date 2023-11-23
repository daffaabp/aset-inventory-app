<?php

function formatRupiah($nominal, $prefix = false)
{
    if ($nominal === '-') {
        return $nominal;
    }

    if ($prefix) {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }

    return number_format($nominal, 0, ',', '.');
}
