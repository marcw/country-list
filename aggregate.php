<?php

require_once __DIR__.'/vendor/autoload.php';

$f = new Symfony\Component\Finder\Finder();

$f->in('country')->name('country.php');

$countries = [];
foreach ($f as $file) {
    $raw = require ($file);
    foreach ($raw as $code => $name) {
        $countries[mb_strtolower($name)] = $code;
    }
}

file_put_contents('countries.aggregate.php', sprintf("<?php\n return %s;", var_export($countries, true)));

