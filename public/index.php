<?php

require_once '../vendor/autoload.php';
require_once '../config/config.php';

use Blog\Core\Application;

$application = new Application();
$application->bootstrap();

return $application->run();

