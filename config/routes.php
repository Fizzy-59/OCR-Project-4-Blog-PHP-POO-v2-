<?php

use Blog\Routing\Router;

Router::add('/home',     ['controller' => 'default', 'action' => 'home'] );
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
Router::add('/admin', ['controller' => 'default', 'action' => 'admin'] );

