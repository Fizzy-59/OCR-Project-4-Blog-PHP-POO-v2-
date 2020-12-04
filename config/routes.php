<?php

use Blog\Routing\Router;

// HOME
Router::add('/home', ['controller' => 'default', 'action' => 'home'] );
Router::add('/', ['controller' => 'default', 'action' => 'home'] );
Router::add('/hello', ['controller' => 'home', 'action' => 'displayHelloPage'] );

Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
Router::add('/article', ['controller' => 'default', 'action' => 'singleArticle'] );
Router::add('/category', ['controller' => 'default', 'action' => 'articleByCategory'] );

Router::add('/add_comment', ['controller' => 'default', 'action' => 'addComment'] );
// ARTICLE
Router::add('/article', ['controller' => 'Article', 'action' => 'singleArticle'] );

// CATEGORY
Router::add('/category', ['controller' => 'Category', 'action' => 'articleByCategory'] );
Router::add('/categories', ['controller' => 'Category', 'action' => 'categories'] );

// LOGIN
Router::add('/login', ['controller' => 'User', 'action' => 'login'] );
Router::add('/logout', ['controller' => 'User', 'action' => 'logout'] );
Router::add('/connection', ['controller' => 'User', 'action' => 'connection'] );

// REGISTRATION
Router::add('/register', ['controller' => 'User', 'action' => 'register'] );
Router::add('/registration', ['controller' => 'User', 'action' => 'registration'] );

Router::add('/add_comment', ['controller' => 'Article', 'action' => 'addComment'] );

// ADMIN
Router::add('/admin/feed_database', ['controller' => 'default', 'action' => 'admin'] );

