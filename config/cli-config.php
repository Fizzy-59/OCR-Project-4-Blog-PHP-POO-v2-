<?php

// File for use CLI dictrine

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Blog\Core\Application;

require realpath('').'/vendor/autoload.php';
require realpath('').'/config/config.php';


$application = new Application();
$application->bootstrap();

// Create the CLI DOCTRINE
require ROOT_DIR."/lib/ORM/entityManager.php";

return ConsoleRunner::createHelperSet($entityManager);