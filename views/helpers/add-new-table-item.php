<?php

declare(strict_types=1);

use \App\Validators\ViewArray;

?>

<form action='' type='POST'>
  <?php foreach ($data as $columnName): ?>
    <label for='<?= $columnName ?>'><?= $columnName ?></label><br>
    <input type='text' name='<?= $columnName ?>'><br>
  <?php endforeach ?>

  <button type='submit' name='submit-new'>Submit</button>
</form>
