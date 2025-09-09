<?php

declare(strict_types=1);

$squareData = $data['squareData'];
$inputString = $data['inputString'];

?>

<h1>Square</h1>
<dl>
        <?php foreach ($squareData as $dataKey => $dataValue): ?>
                <dt><?= $dataKey ?></dt>
                <dd><?= $dataValue ?></dd>
        <?php endforeach ?>
</dl>
