<?php

use \App\Services\Database;

$db = Database::getInstance();
$pdo = $db->getConnection();

?>

<form action="" method="GET">
  <label for="tableName">Input the table name there</label>
  <input type="text" name="tableName" id="tableName">
  <button type="submit">Sumbit</button>
</form>

<?php if (isset($_GET['tableName'])): ?>
  <p><strong>Result:</strong></p>
  <pre>
<?php

  $statement = $pdo->prepare('SELECT * FROM :input;');
  $statement->bindParam('input', $_GET['tableName'], PDO::PARAM_STR);
  $statement->execute();
  var_dump($statement->fetchAll());

?>

</pre>
<?php endif ?>
