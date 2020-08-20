<?php

use Blog\Routing\Router;

Router::add('/',     ['controller' => 'default', 'action' => 'home'] );
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
Router::add('/admin/test', ['controller' => 'default', 'action' => 'admin'] );

