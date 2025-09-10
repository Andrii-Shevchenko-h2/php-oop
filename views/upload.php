<?php

declare(strict_types=1);

use \App\FileManager\Uploader;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile'])) {
  Uploader::upload($_FILES['userfile']);
}

?>

<form enctype="multipart/form-data" action="" method="POST">
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <label for="userfile">Send this file:</label><br>
  <input name="userfile" type="file" /><br>
  <input type="submit" value="Send File" />
</form>
