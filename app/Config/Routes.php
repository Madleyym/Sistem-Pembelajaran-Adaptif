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

$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Admin Routes
    $routes->group('admin', function ($routes) {
        $routes->get('/', 'Admin::index');
        // Tambahkan route admin lainnya di sini
    });

    // Guru Routes
    $routes->group('guru', function ($routes) {
        $routes->get('/', 'Guru::index');
        // Tambahkan route guru lainnya di sini
    });

    // Siswa Routes
    $routes->group('siswa', function ($routes) {
        $routes->get('/', 'Siswa::index');
        // Tambahkan route siswa lainnya di sini
    });

    // Orangtua Routes
    $routes->group('orangtua', function ($routes) {
        $routes->get('/', 'Orangtua::index');
        // Tambahkan route orangtua lainnya di sini
    });
});