<?php
/*ID: 612110237
Name: Guineng Cai 
*/
require_once './vendor/autoload.php';

use MathPHP\LinearAlgebra\MatrixFactory;

$fp = fopen($_SERVER['argv'][1], 'r');
fscanf($fp, "%d %d %d", $m, $n, $p);

$matInputs = [];
foreach([[$m, $n], [$n, $p]] as $index => list($row, $col)) {
    $mat = [];
    $colFormat = trim(str_repeat("%d ", $col));
    for($j = 0; $j < $row; $j++) {
        $mat[] = fscanf($fp, $colFormat);
    }
    $matInputs[$index] = $mat;
}

fclose($fp);

$matA = MatrixFactory::create($matInputs[0]);
$matB = MatrixFactory::create($matInputs[1]);
$matC = $matA->multiply($matB);

foreach([
    ['title' => "Input matrix A",      'mat' => $matA],
    ['title' => "Input matrix B",      'mat' => $matB],
    ['title' => "The result matrix C", 'mat' => $matC],
] as list('title' => $title, 'mat' => $mat)) {
    printf("%s(%2d x %2d):\n", $title, $mat->getM(), $mat->getN());
    foreach($mat->getMatrix() as $rows) {
        foreach($rows as $value) printf("%5d", $value);
        printf("\n");
    }
    printf("\n");
}
