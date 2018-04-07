<?php

Route::group([
		'middleware' => 'api', 
		'prefix' => 'inventory', 
		'namespace' => 'Modules\Inventory\Http\Controllers'
	], function() {
    Route::get('/', 'InventoryController@index');

    Route::apiResource('categories', 'CategoryController');
});
