<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->resource("mahasiswa");


$routes->resource("dosen");

$routes->resource("kelas");

$routes->resource("nilai");

$routes->resource("matakuliah");

$routes->resource("prodi");

$routes->resource('nilaiview'); // otomatis: /nilaiview dan /nilaiview/{id}


