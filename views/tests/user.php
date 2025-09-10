<?php

declare(strict_types=1);

use \App\View;

// sorry, this should have been handled by a service or controller :(
$parsedData = [];
$parsedData['name'] = $data['name'];
$parsedData['birthDate'] = ($data['birthDate'])->format('l, jS F, Y');
$parsedData['mail'] = $data['mail'];
$parsedData['age'] = ($data['age'])->format('%y Years');
$parsedData['joinDate'] = isset($data['joinDate']) ? $data['joinDate']->format('Y \y\e\a\r\s \a\n\d F \m\o\n\t\h\s') : 'Not a member';

?>

<h1>User</h1>
<?php View::render('helpers/unit_test.php', $parsedData) ?>
