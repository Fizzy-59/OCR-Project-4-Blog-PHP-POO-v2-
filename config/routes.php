<?php

use Blog\Routing\Router;

// HOME
Router::add('/',             ['controller' => 'home', 'action' => 'displayHelloPage'] );
Router::add('/home',         ['controller' => 'home', 'action' => 'displayHelloPage'] );
Router::add('/hello',        ['controller' => 'home', 'action' => 'displayHelloPage'] );
Router::add('/contact_form', ['controller' => 'home', 'action' => 'contactForm'     ] );

// CONTENT
Router::add('/add_comment', ['controller' => 'default', 'action' => 'addComment'] );

// ARTICLE
Router::add('/article',     ['controller' => 'article', 'action' => 'article'] );
Router::add('/articles',    ['controller' => 'article', 'action' => 'articles'] );
Router::add('/add_comment', ['controller' => 'Article', 'action' => 'addComment'] );

// CATEGORY
Router::add('/category',   ['controller' => 'category', 'action' => 'articleByCategory'] );
Router::add('/categories', ['controller' => 'category', 'action' => 'categories'] );

// LOGIN
Router::add('/login',      ['controller' => 'user', 'action' => 'login'] );
Router::add('/logout',     ['controller' => 'user', 'action' => 'logout'] );
Router::add('/connection', ['controller' => 'user', 'action' => 'connection'] );
Router::add('/forgot',     ['controller' => 'user', 'action' => 'forgot'] );


// REGISTRATION
Router::add('/register',     ['controller' => 'User', 'action' => 'register'] );
Router::add('/registration', ['controller' => 'User', 'action' => 'registration'] );


// ADMIN
Router::add('/admin/feed_database',     ['controller' => 'admin', 'action' => 'generateData'] );
Router::add('/admin/moderate',          ['controller' => 'admin', 'action' => 'moderate'] );
Router::add('/admin/add_article',       ['controller' => 'admin', 'action' => 'displayAddArticle'] );
Router::add('/admin/new_article',       ['controller' => 'admin', 'action' => 'addArticle'] );
Router::add('/admin/modify_article',    ['controller' => 'admin', 'action' => 'updateArticle'] );
Router::add('/admin/dashboard',         ['controller' => 'admin', 'action' => 'dashboard'] );
Router::add('/admin/article_dashboard', ['controller' => 'admin', 'action' => 'dashboardArticle'] );
Router::add('/admin/update_article',    ['controller' => 'admin', 'action' => 'displayUpdateArticle'] );
Router::add('/admin/delete_article',    ['controller' => 'admin', 'action' => 'deleteArticle'] );

// DEBUG
Router::add('/test', ['controller' => 'default', 'action' => 'test'] );
