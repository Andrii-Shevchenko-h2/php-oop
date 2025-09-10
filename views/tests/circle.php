<?php

declare(strict_types=1);

use \BcMath\Number;
use \App\View;

$circleData = $data['circleData'];
$inputString = $data['inputString'];

$parsedData = [];
$parsedData['input'] = $data['inputString'];

foreach ($circleData as $dataKey => $dataValue) {
        if ($dataValue instanceof Number) {
                $currentValue = $dataValue->value;
        } else {
                $currentValue = $dataValue;
        }

        $parsedData[$dataKey] = $currentValue;
}

?>

<h1>Circle</h1>
<?php View::render('helpers/unit_test.php', $parsedData) ?>
