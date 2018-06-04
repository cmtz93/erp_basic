<?php

Route::group([
		'middleware' => 'api', 
		'prefix' => 'inventory', 
		'namespace' => 'Modules\Inventory\Http\Controllers'
	], function() {
    Route::get('/', 'InventoryController@index');

    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('manufacturers', 'ManufacturerController');
    
    Route::apiResource('statuses', 'StatusController');
    Route::apiResource('attributes', 'AttributeController');
    Route::apiResource('values', 'ValueController');
    
    Route::apiResource('products', 'ProductController');

});
