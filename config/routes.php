<?php

use Blog\Routing\Router;

Router::add('/home', ['controller' => 'default', 'action' => 'home'] );
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
Router::add('/article', ['controller' => 'default', 'action' => 'singleArticle'] );
Router::add('/category', ['controller' => 'default', 'action' => 'articleByCategory'] );

Router::add('/add_comment', ['controller' => 'default', 'action' => 'addComment'] );

// ADMIN
Router::add('/admin/feed_database', ['controller' => 'default', 'action' => 'admin'] );

