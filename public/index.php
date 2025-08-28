<?php

declare(strict_types = 1);

require_once('../app/modern/Customer.php');
require_once('../app/ancient/Customer.php');

use App\Modern;
use App\Ancient;

$angelo = new Modern\Customer('Angelo Merte', '17.07.1954');
echo $angelo->mail->address, PHP_EOL;

$hercules = new Ancient\Customer('Hercules', '12.08.1000');
echo $hercules->mail->address, PHP_EOL;
