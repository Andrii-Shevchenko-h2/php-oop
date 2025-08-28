<?php

declare(strict_types = 1);

use \App\Modern\Customer as ModernCustomer;
use \App\Ancient\Customer as AncientCustomer;

$angelo = ModernCustomer::create('Angelo Merte', '17.07.1954');
$olaf = ModernCustomer::create('Olaf Holz', '14.06.1958');
$hercules = AncientCustomer::create('Hercules', '12.08.1000');

$customerNumber = 0;

$generateCustomerTestText = function(ModernCustomer|AncientCustomer $customer) use (&$customerNumber) {
  $customerNumber++;
  $customerName = $customer instanceof ModernCustomer
    ? $customer->name
    : $customer->getName();
  $customerBirthDate = $customer instanceof ModernCustomer
    ? $customer->birthDate
    : $customer->getBirthDate();

  return <<< CUSTOMER_TEST
  CUSTOMER $customerNumber
    Name: $customerName
    Birth Date: $customerBirthDate
    Age: $customer->age
    Mail: {$customer->mail->address}
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
