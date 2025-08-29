<?php

declare(strict_types = 1);

namespace App\Tests;

use \App\Customer\Customer;

readonly class CustomerTests extends Tests {
  protected static function runTests() {
    $angelo = Customer::create('Angelo Merte', '17.07.1954');
    $olaf = Customer::create('Olaf Holz', '14.06.1958');
    $hercules = Customer::create('Hercules', '12.08.1000');

    $customerNumber = 0;

    $generateCustomerTestText = function(Customer $customer) use (&$customerNumber) {
      $customerNumber++;

      return <<< CUSTOMER_TEST
      CUSTOMER $customerNumber
        Name: {$customer->name}
        Birth Date: {$customer->birthDate}
        Age: $customer->age
        Mail: {$customer->mail}
      ---
      CUSTOMER_TEST;
    };

    $angeloTest = $generateCustomerTestText($angelo);
    $herculesTest = $generateCustomerTestText($hercules);
    $olafTest = $generateCustomerTestText($olaf);

    print <<< CUSTOMER_TESTS
    -----------CUSTOMER TESTS-------------
    $angeloTest
    $herculesTest
    $olafTest
    CUSTOMER_TESTS . PHP_EOL;
  }
}
