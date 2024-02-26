<?php

use Nikolay\EntryChallenge\PreorderCalculator;

require_once('vendor/autoload.php');

const MAX_NUM = 5;

$calculator = new PreorderCalculator();

$out = [];
for ($i = 0; $i <= MAX_NUM; $i++) {
    $out[] = $calculator->calculate($i);
}

echo '[' . join(',', $out) . ']' . "\n";
