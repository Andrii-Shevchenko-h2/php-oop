<?php

declare(strict_types=1);

use \BcMath\Number;
use \App\View;

$squareData = $data['squareData'];
$inputString = $data['inputString'];

$parsedData = [];
$parsedData['input'] = $data['inputString'];

foreach ($squareData as $dataKey => $dataValue) {
        if ($dataValue instanceof Number) {
                $currentValue = $dataValue->value;
        } else {
                $currentValue = $dataValue;
        }

        $parsedData[$dataKey] = $currentValue;
}

?>

<h1>Square</h1>
<?php View::render('helpers/unit_test.php', $parsedData) ?>
