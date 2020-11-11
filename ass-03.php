<?php
/*ID: 612110237
Name: Guineng Cai 
*/
require_once './vendor/autoload.php';

use MathPHP\Functions\Polynomial;

$fp = fopen($_SERVER['argv'][1], 'r');
fscanf($fp, "%d", $n);
for($i = 0; $i < $n; $i++) {
    $line = trim(fgets($fp));
    $coffs = array_map(function($value) {
        return (double)$value;
    }, preg_split('/\s+/', $line));
    $polynomail = new Polynomial($coffs);
    $roots = $polynomail->roots();
    printf("%s\n", $polynomail);
    printf("    Roots: %s\n", implode(", ", $roots));
}
fclose($fp);
