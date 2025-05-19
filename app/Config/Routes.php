<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // Routing untuk resource controller mahasiswa
$routes->resource("mahasiswa");

// Routing untuk resource controller dosen
$routes->resource("dosen");

// Routing untuk resource controller kelas
$routes->resource("kelas");

// Routing untuk resource controller nilai
$routes->resource("nilai");

// Routing untuk resource controller matakuliah
$routes->resource("matakuliah");

// Routing untuk resource controller prodi
$routes->resource("prodi");

// Routing untuk menampilkan view khusus nilai (bukan resource)
$routes->get('nilaiview', 'NilaiView::index');





