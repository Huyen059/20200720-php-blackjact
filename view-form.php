<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Black Jack</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="radio" name="hit" id="hit">Hit
    <input type="radio" name="stand" id="stand">Stand
    <input type="radio" name="surrender" id="surrender">Surrender
    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>
