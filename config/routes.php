<?php

use Blog\Routing\Router;

Router::add('/home', ['controller' => 'default', 'action' => 'home'] );
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
Router::add('/admin/feed_database', ['controller' => 'default', 'action' => 'admin'] );

