<?php

require ROOT_DIR."/vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Config entity Manager DOCTRINE

$paths = array(ROOT_DIR."/src");
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;


$access = require ROOT_DIR."/config/database.php";

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
$config->addEntityNamespace('', 'App\Entity');

// For doctrine CLI
$entityManager = EntityManager::create($access, $config);

return EntityManager::create($access, $config);