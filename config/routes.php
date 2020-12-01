<?php

use Blog\Routing\Router;

Router::add('/home', ['controller' => 'default', 'action' => 'home'] );
Router::add('/', ['controller' => 'default', 'action' => 'home'] );
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );

// CONTENT
Router::add('/article', ['controller' => 'Article', 'action' => 'singleArticle'] );
Router::add('/category', ['controller' => 'Article', 'action' => 'articleByCategory'] );

// LOGIN
Router::add('/login', ['controller' => 'User', 'action' => 'login'] );
Router::add('/logout', ['controller' => 'User', 'action' => 'logout'] );
Router::add('/connection', ['controller' => 'User', 'action' => 'connection'] );

// Registration
Router::add('/register', ['controller' => 'User', 'action' => 'register'] );
Router::add('/registration', ['controller' => 'User', 'action' => 'registration'] );

Router::add('/add_comment', ['controller' => 'Article', 'action' => 'addComment'] );

// ADMIN
Router::add('/admin/feed_database', ['controller' => 'Admin', 'action' => 'admin'] );
Router::add('/admin/moderate_comment', ['controller' => 'Admin', 'action' => 'displayModerateComment'] );
Router::add('/moderate', ['controller' => 'Admin', 'action' => 'moderate'] );
Router::add('/add_article', ['controller' => 'Admin', 'action' => 'displayAddArticle'] );
Router::add('/new_article', ['controller' => 'Admin', 'action' => 'addArticle'] );

