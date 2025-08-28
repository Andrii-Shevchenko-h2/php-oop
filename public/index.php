<?php

declare(strict_types = 1);

require_once(dirname(__DIR__). '/vendor/autoload.php');

use App\Modern\Customer as ModernCustomer;
use App\Ancient\Customer as AncientCustomer;

$angelo = ModernCustomer::create('Angelo Merte', '17.07.1954');
echo $angelo?->mail->address, PHP_EOL;

$hercules = AncientCustomer::create('Hercules', '12.08.1000');
echo $hercules?->mail->address, PHP_EOL;
