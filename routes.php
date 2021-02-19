<?php

use MamcoSy\Router\Router;

Router::get('/', 'App\Controllers\HomeController@index');
Router::get('/employees', 'App\Controllers\HomeController@getAllEmployees');
Router::get('/employees/{int:id}', 'App\Controllers\HomeController@findEmployee');
Router::get('/employees/{int:id}/delete', 'App\Controllers\HomeController@deleteEmployee');
Router::post('/employees/{int:id}/update', 'App\Controllers\HomeController@updateEmployee');
