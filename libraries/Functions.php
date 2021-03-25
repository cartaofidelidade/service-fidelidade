<?php

function retornar_duas_casas($numero)
{
    if (!is_numeric(str_replace(',', '.', $numero))) {
        $numero = 0;
    }
    if ($numero > -1) {
        //$numero=str_replace('-','0',$numero);
        $numero = str_replace(",", ".", $numero);
        $numero = number_format($numero, 2, ',', '.');
    } else {
        $numero = str_replace('-', '0', $numero);
        $numero = str_replace(",", ".", $numero);
        if ($numero > -1) {
            $numero = '-' . number_format($numero, 2, ',', '.');
        } else {
            $numero = '0,00';
        }
    }
    return $numero;
}

function retornar_tres_casas($numero)
{
    if (!is_numeric(str_replace(',', '.', $numero))) {
        $numero = 0;
    }
    if ($numero > -1) {
        //$numero=str_replace('-','0',$numero);
        $numero = str_replace(",", ".", $numero);
        $numero = number_format($numero, 3, ',', '.');
    } else {
        $numero = str_replace('-', '0', $numero);
        $numero = str_replace(",", ".", $numero);
        if ($numero > -1) {
            $numero = '-' . number_format($numero, 2, ',', '.');
        } else {
            $numero = '0,00';
        }
    }
    return $numero;
}

function retornar_quatro_casas($numero)
{
    if (!is_numeric(str_replace(',', '.', $numero))) {
        $numero = 0;
    }
    if ($numero > -1) {
        //$numero=str_replace('-','0',$numero);
        $numero = str_replace(",", ".", $numero);
        $numero = number_format($numero, 4, ',', '.');
    } else {
        $numero = str_replace('-', '0', $numero);
        $numero = str_replace(",", ".", $numero);
        if ($numero > -1) {
            $numero = '-' . number_format($numero, 4, ',', '.');
        } else {
            $numero = '0,00';
        }
    }
    return $numero;
}

function retornar_duas_casas_ingles($numero)
{
    $numero = str_replace(".", "", $numero);
    $numero = str_replace(",", ".", $numero);
    return $numero;
}

function retornar_tres_casas_ingles($numero)
{
    $numero = str_replace(".", "", $numero);
    $numero = str_replace(",", ".", $numero);
    return $numero;
}

function apenas_numeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

function documento($documento)
{
    if (strlen($documento) === 14) {
        return substr($documento, 0, 2) . '.' . substr($documento, 2, 3) . '.' . substr($documento, 5, 3) . '/' . substr($documento, 8, 4) . '-' . substr($documento, 12, 2);
    } elseif (strlen($documento) === 11) {
        return substr($documento, 0, 3) . '.' . substr($documento, 3, 3) . '.' . substr($documento, 6, 3) . '-' . substr($documento, 9, 2);
    }
    return $documento;
}