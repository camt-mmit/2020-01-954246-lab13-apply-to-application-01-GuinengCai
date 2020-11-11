<?php
/*ID: 612110237
Name: Guineng Cai 
*/
require_once './vendor/autoload.php';

use MathPHP\LinearAlgebra\MatrixFactory;
use MathPHP\LinearAlgebra\Vector;

$fp = fopen($_SERVER['argv'][1], 'r');

fscanf($fp, "%d", $m);

$eqs = [];
for($i = 0; $i < $m; $i++) {
    $n = null;
    fscanf($fp, "%d", $n);
    $colFormat = trim(str_repeat("%f ", $n + 1));
    $matA = [];
    $matb = [];
    for($j = 0; $j < $n; $j ++) {
        $cols = fscanf($fp, $colFormat);
        $matb[] = array_pop($cols);
        $matA[] = $cols;
    }
    $eqs[] = ['A' => $matA, 'b' => $matb];
}

fclose($fp);

foreach($eqs as $index => list('A' => $matA, 'b' => $matb)) {
    $matA = MatrixFactory::create($matA);
    $results = array_map(function($value) {
        return sprintf("%6.2f", $value);
    }, $matA->solve(new Vector($matb))->getVector());
    printf("%s\n", implode(", ", $results));
}
