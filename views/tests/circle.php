<?php

declare(strict_types=1);

$circleData = $data['circleData'];
$inputString = $data['inputString'];

?>

<h1>Circle</h1>
<?php foreach ($circleData as $dataKey => $dataValue): ?>
        <dl>
                <dt><?= $dataKey ?></dt>
                <dd><?= $dataValue ?></dd>
        </dl>
<?php endforeach; ?>
