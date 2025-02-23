<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('logout', 'Auth::logout');

$routes->get('admin', 'Admin::index', ['filter' => 'auth']);


$routes->get('chatbot', 'ChatBot::index', ['filter' => 'auth']);
$routes->post('chatbot/sendMessage', 'ChatBot::sendMessage', ['filter' => 'auth']);

// Routes yang memerlukan autentikasi
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::dashboard');
});

$routes->group('guru', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Guru::dashboard');
});

$routes->group('siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Siswa::dashboard');
});

$routes->group('orangtua', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Orangtua::dashboard');
});