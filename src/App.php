<?php
namespace MyApp;

use MathPHP\Algebra;
use MathPHP\Arithmetic;
use MathPHP\Functions\Polynomial;

class App
{
    function run()
    {
        while(true) {
            printf(<<<EOT
1. Calculate GCD (Greatest common divisor).
2. Calculate root n(th) of given number.
3. Calculate differentiate.
0. Exit

EOT
            );
            printf("Input menu: ");
            fscanf(STDIN, "%d", $menu);
            if($menu === 0) break;
            
            printf("\n");
            switch($menu) {
                case 1:
                    printf("Input numbers (num1 num2): ");
                    fscanf(STDIN, "%d %d", $num1, $num2);
                    printf("GCD of %3d and %3d is %3d\n",
                        $num1, $num2, Algebra::gcd($num1, $num2));
                break;
                case 2:
                    printf("Input data (root number): ");
                    fscanf(STDIN, "%d %d", $root, $num);
                    printf("Root %3d(th) of %3d is %3d\n",
                        $root, $num, Arithmetic::root($num, $root));
                break;
                case 3:
                    printf(<<<EOT
Polynomial: c1*x^(n - 1) + c2*x^(n - 2) + ... + cn
Coefficients c1, c2, ... and cn are floating-point

EOT
                    );
                    printf("Input coefficients (c1 c2 ... cn): ");
                    $text = trim(fgets(STDIN));
                    $coeffs = array_map(function($value) {
                        return (double)$value;
                    }, preg_split('/\s+/', $text));
                    $polynomial = new Polynomial($coeffs);
                    printf("Differentiate of %s is %s\n",
                        $polynomial, $polynomial->differentiate());
                break;
                default:
                    printf(STDERR, "Invalid menu number %d !!!!\n", $menu);
            }
            printf("\n");
        }
    }
}
