<?php

Route::name('crm.')->group(function () {
    Route::get('/', 'CRM\IndexController@dashboard');
    Route::get('/traders', 'CRM\IndexController@traders')->name('traders');
    Route::get('/trader/{id}', 'CRM\TradersController@getTrader')->name('getTrader');
    Route::group(['prefix'=> 'data'], function() {
        Route::get('getCalls', 'ImportController@getCalls')->name('calls');
        Route::post('getTraders', 'CRM\TradersController@getTraders')->name('getTraders');
    });

//    Email page
    Route::get('/emails', 'CRM\IndexController@emails')->name('emails');
//    Email settings
    Route::get('/emails/settings', 'CRM\EmailSettingController@getAllSettings');
    Route::post('/emails/settings', 'CRM\EmailSettingController@updateSettings');
//    Email actions
    Route::get('/emails/actions', 'CRM\EmailActionController@getAllActions');
    Route::post('/emails/actions', 'CRM\EmailActionController@updateActions');
});


