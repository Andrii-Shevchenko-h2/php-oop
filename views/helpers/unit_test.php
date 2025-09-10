<?php

declare(strict_types=1);

use \App\Validators\UnitTest;

UnitTest::validate($data);

?>

<dl>
  <?php foreach ($data as $dataKey => $dataValue): ?>
    <dt><?= $dataKey ?></dt>
    <dd><?= $dataValue ?></dd>
  <?php endforeach ?>
