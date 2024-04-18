<?php

require dirname(__DIR__).'/vendor/autoload.php';

use HighLiuk\Vite\Vite;
use HighLiuk\Vite\Manifest;

$manifest = new Manifest(__DIR__.'/assets/', '/assets/');
$vite = new Vite($manifest);

?>

<!doctype html>
<html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>On the backend</title>
      <?= $vite->tags() ?>
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
