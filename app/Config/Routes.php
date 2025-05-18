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

$routes->get('nilaiview', 'NilaiView::index');

$routes->get('mahasiswa/getMahasiswaByNpm/(:segment)', 'MahasiswaController::getMahasiswaByNpm/$1');


