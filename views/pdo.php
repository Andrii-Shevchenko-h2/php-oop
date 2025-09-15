<?php

use \App\Core\View;
use \App\Services\Database;
use \App\Exceptions\AppException;

$db = Database::getInstance();
$pdo = $db->getConnection();

session_start();

$makeStrValues = function (array &$array) {
  foreach ($array as $tableKey => &$tableValue) {
    if (gettype($tableKey) !== 'string') {
      $tableKey = strval($tableKey);
    }

    if (gettype($tableValue) !== 'string') {
      $tableValue = strval($tableValue);
    }
  }
}
?>

<form action='' method='GET'>
  <label for='table-name'>Input the table name there</label><br>
  <select name='table-name' id='table-name'>
    <?php foreach ($pdo->query('SHOW TABLES')->fetchAll() as $table): ?>
      <option value='<?= $table['Tables_in_my_db'] ?>'><?= $table['Tables_in_my_db'] ?></option>
    <?php endforeach ?>
  </select>
  <button type='submit' <?php if (isset($_GET['table-name'])) print 'disabled'; ?>>Sumbit</button>
</form>

<?php if (isset($_GET['table-name'])): ?>
  <p><strong>Result:</strong></p>
  <?php

  if (!in_array($_GET['table-name'], array_column($pdo->query('SHOW TABLES')->fetchAll(), 'Tables_in_my_db'))) {
    AppException::badQueryDB();
  }

  $statement = $pdo->query('SELECT * FROM ' . $_GET['table-name']);
  $tableInformations = $statement->fetchAll();

  foreach ($tableInformations as &$tableInformation):
    $makeStrValues($tableInformation);

    View::render('helpers/view_array.php', $tableInformation);
  ?>
    <form action='' method='POST'>
      <button type='submit' name='add-new'>Add new</button>
    </form>
  <?php endforeach; ?>

  <?php
  if (isset($_POST['add-new']) && !isset($_POST['submit-new'])) {
    $tableColumns = $pdo->query('DESCRIBE ' . $_GET['table-name'])->fetchAll(PDO::FETCH_COLUMN);
    $_SESSION['table-columns'] = $tableColumns;

    $makeStrValues($tableColumns);

    View::render('helpers/add-new-table-item.php', $tableColumns);
  }

  if (isset($_POST['submit-new'])) {
    $placeholders = [];
    $keys = [];
    $values = [];
    $table = $_SESSION['table-name'];

    foreach ($_SESSION['table-columns'] as $columnName) {
      $placeholders[] = '?';
      $keys[] = $columnName;
      $values[] = $_POST[$columnName];
    }

    $keysString = implode(',', $keys);
    $placeholdersString = implode(',', $placeholders);

    $statement = $pdo->prepare(
      "INSERT INTO $table ($keysString) VALUES ($placeholdersString)"
    );

    $statement->execute($values);
  }
  ?>
<?php endif ?>
