<?php
/**
 * In order to check if a number is a prime number ("número primo" in Spanish) there are several ways.
 * I am doing it for analyzing this to draw conclusions at runtime. Better strategy?
 * Functions:
 * - theChecker($numbersToCheck, $maxNumber) --> Check a random quantity of numbers with a maximum number of size.
 * - getRandomListOfNumbers($numbersToCheck, $maxNumber): Array   --> Generate several numbers to check.
 * - listOfPrimeNumbers($numMaxToCheck): array  --> Generate the list of prime numbers from 2 to X ($numMaxToCheck).
 * - function showListOfPrimeNumbers($numMaxToCheck)
 * - isPrime0(..), isPrime1(..), ... isPrime6(..) --> Functions for check if a number is or not a prime number.
 *
 * @author José Manuel Muñoz Simó | irotdev
 * @version v1.0
 */


theChecker (1, 100);
theChecker (10, 500);
theChecker (100, 1000);

//theChecker (100, 100);
//theChecker (100, 1000);
//theChecker (100, 10000);
//theChecker (100, 100000);
//theChecker (100, 1000000);    // Don't use for isPrime0 or isPrime1
//theChecker (100, 10000000);   // Don't use for isPrime0, isPrime1, or isPrime2
//theChecker (100, 100000000);  // Don't use for isPrime0, isPrime1, or isPrime2
//theChecker (100, 1000000000); // Don't use for isPrime0, isPrime1, or isPrime2

//showListOfPrimeNumbers($maxNumber);

function theChecker($numbersToCheck, $maxNumber): void {
    echo "<br><br>**************************************************<br>";
    echo "***** [$numbersToCheck] numbers to check with a maximum of [$maxNumber]";
    echo "<br>**************************************************<br><br>";
    $listOfNumbersToCheck = getRandomListOfNumbers($numbersToCheck, $maxNumber);


    // isPrime0
    echo "Checking 'isPrime0':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime0($value, $maxNumber) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime0 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime1
    echo "Checking 'isPrime1':<br>";
    $time_start = microtime(true);
    $listPrimeNumbers =  listOfPrimeNumbers($maxNumber);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime1($value, $listPrimeNumbers) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime1 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime2
    echo "Checking 'isPrime2':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime2($value) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime2 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime3
    echo "Checking 'isPrime3':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime3($value) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime3 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime4
    echo "Checking 'isPrime4':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime4($value) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime4 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime5
    echo "Checking 'isPrime5':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime5($value) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime5 TIME: " . number_format($diff, 10) . "<br><br><br>";


    // isPrime6
    echo "Checking 'isPrime6':<br>";
    $time_start = microtime(true);
    foreach ($listOfNumbersToCheck as $value) {
        echo " [$value is" . (isPrime6($value) ? " TRUE" : " FALSE") . "] ";
    }
    $time_end = microtime(true);
    $diff = $time_end - $time_start;
    echo "<br>isPrime6 TIME: " . number_format($diff, 10) . "<br><br><br>";
}



/**
 * Get an array of numbers ($numbersToCheck numbers) with a random value between 1 and X ($maxNumber)
 * @param $numbersToCheck
 * @param $maxNumber
 * @return array
 */
function getRandomListOfNumbers($numbersToCheck, $maxNumber): Array {
    $listOfNumbers = array();
    for ($i = 0; $i < $numbersToCheck; $i++) $listOfNumbers[] = rand(2, $maxNumber);
    return $listOfNumbers;
}


/**
 * Generate a list of prime numbers until the number indicated ($numMaxToCheck).
 * @param $numMaxToCheck
 * @return array
 */
function listOfPrimeNumbers($numMaxToCheck): array {
    $primeNumbers = array();
    $primeNumbers[] = 2;
    for ($i = 3; $i <= $numMaxToCheck; $i++) {
        $isPrime = true;
        foreach ($primeNumbers as $value) {
            if ($i % $value == 0) {
                $isPrime = false;
                break;
            }
        }
        if ($isPrime) $primeNumbers[] = $i;   // Add a new number prime
    }
    return $primeNumbers;
}


function showListOfPrimeNumbers($numMaxToCheck) {
    $listPrimeNumbers =  listOfPrimeNumbers($numMaxToCheck);
    foreach ($listPrimeNumbers as $value)
        echo $value . " ";
}


/**
 * Strategy for prime numbers: Generate a list of prime numbers and latter check if the number is in the list.
 * Here, due to the "self generation" of number until a "maxNumberToCheck", if the number to check is small, it is a
 * bad idea. If the number is big, it is also a bad idea because you don't need the extra "bigger numbers". In fact, if
 * only check a number, it is ok to call to get the array (however, if you are going to check a lot of numbers, save
 * this list in a global variable and call only once, as do "isPrime1(..)".
 * @param $num
 * @param $maxNumberToCheck
 * @return bool
 */
function isPrime0($num, $maxNumberToCheck): bool {
    $listPrimeNumbers =  listOfPrimeNumbers($maxNumberToCheck);
    foreach ($listPrimeNumbers as $numPrime)
        if ($num == $numPrime)
            return true;

    return false;
}


/**
 * Strategy for prime numbers: With a previous list of prime numbers, check if the number is in the list.
 * It could be good if we check a lot of numbers very big.
 * @param $num
 * @param $maxNumberToCheck
 * @return bool
 */
function isPrime1($num, $listPrimeNumbers): bool {
    return in_array($num, $listPrimeNumbers);
}


/**
 * Strategy for prime numbers: Checking if a number is a prime number since 0 to the same num.
 * For only some numbers, it could be a good solution, but it is not necessary check until the same number. However,
 * if we have to check a lot of numbers, maybe there are others better solutions. A better solution is "isPrime3(..)",
 * which is very similar to this one.
 * @param $num
 * @return bool
 */
function isPrime2($num): bool {
    for ($i = 2; $i < $num; $i++)
        if ($num % $i == 0)
            return false;

    return true;
}


/**
 * Strategy for prime numbers: Checking if a number is a prime number since 0 to the sqrt of the num.
 * For only some numbers, it could be a very good solution. However, if we should to check a lot of numbers, maybe
 * there are others better solutions.
 * @param $num
 * @return bool
 */
function isPrime3($num): bool {
    for ($i = 2; $i <= sqrt($num); $i++)
        if ($num % $i == 0)
            return false;

    return true;
}


/**
 * Strategy for prime numbers: Checking if a number is a prime number since 0 to the sqrt of the num, saving sqrt into
 * a variable.
 * Very similar to "isPrime3(..)", but, due that "isPrime2" is sometimes quicker than "isPrime3" it is possible that
 * the reason is the calc of sqrt, because the numbers to checks is pretty smaller.
 * @param $num
 * @return bool
 */
function isPrime4($num): bool {
    $max = sqrt($num);
    for ($i = 2; $i <= $max; $i++)
        if ($num % $i == 0)
            return false;

    return true;
}


/**
 * Strategy for prime numbers: Checking if a number is a prime number since 0 to the sqrt of the num, saving sqrt into
 * a variable, and doing a loop adding 2 and not 1.
 * Very similar to "isPrime5(..)", but, probably, more quick, because it is not going to check the
 * even numbers (because checking the 2 number is good enough).
 * @param $num
 * @return bool
 */
function isPrime5($num): bool {
    $max = sqrt($num);
    if ($num % 2 == 0) return false;
    for ($i = 3; $i <= $max; $i+=2)
        if ($num % $i == 0)
            return false;

    return true;
}


/**
 * Strategy for prime numbers: Checking if a number is a prime number since 0 to the sqrt of the num, saving sqrt into
 * a variable, and doing a loop adding 2 and not 1.
 * Very similar to "isPrime5(..)", but, probably, more quick, because it is not going to check the
 * even numbers (because checking the 2 number is good enough).
 * @param $num
 * @return bool
 */
function isPrime6($num): bool {
    $max = sqrt($num);
    if (($num % 2 == 0) || ($num % 3 == 0)) return false;
    for ($i = 5; $i <= $max; $i+=6)
        if (($num % $i == 0) || ($num % ($i+2) == 0))
            return false;

    return true;
}

