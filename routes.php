<?php

use MamcoSy\Router\Router;

Router::get('/', 'App\Controllers\HomeController@index');
Router::post('/login', 'App\Controllers\HomeController@login');
Router::get('/employees', 'App\Controllers\HomeController@getAllEmployees');
Router::get('/pointage', 'App\Controllers\HomeController@pointage');
Router::get('/employees/{int:id}', 'App\Controllers\HomeController@findEmployee');
Router::get('/employees/{int:id}/delete', 'App\Controllers\HomeController@deleteEmployee');
Router::post('/employees/{int:id}/update', 'App\Controllers\HomeController@updateEmployee');
Router::post('/insertPointage', 'App\Controllers\HomeController@InsertPointage');
