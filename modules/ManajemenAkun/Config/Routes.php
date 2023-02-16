<?php

/* 
    Define ManajemenAkun Routes
*/
$routes->get('manajemenAkun', '\Modules\ManajemenAkun\Controllers\ManajemenAkun::index');
$routes->put('manajemenAkun/ubah/(:any)', '\Modules\ManajemenAkun\Controllers\ManajemenAkun::edit/$1');
