<?php

Route::name('crm.')->group(function () {
    Route::get('/', 'CRM\IndexController@dashboard');
    Route::get('/traders', 'CRM\IndexController@traders')->name('traders');
    Route::get('/trader/{id}', 'CRM\TradersController@getTrader')->name('getTrader');
    Route::group(['prefix' => 'data'], function () {
        Route::get('getCalls', 'ImportController@getCalls')->name('calls');
        Route::post('getTraders', 'CRM\TradersController@getTraders')->name('getTraders');
    });
    Route::group(['prefix' => 'emails'], function () {
        //    Email page
        Route::get('/', 'CRM\IndexController@emails')->name('emails');
        //    Email settings
        Route::get('settings', 'CRM\EmailSettingController@getAllSettings');
        Route::post('settings', 'CRM\EmailSettingController@updateSettings');
        //    Email actions
        Route::get('actions', 'CRM\EmailActionController@getAllActions');
        Route::post('actions', 'CRM\EmailActionController@updateActions');
        //    Email templates
        Route::get('templates', 'CRM\EmailTemplateController@getAllTemplates');
        Route::post('templates', 'CRM\EmailTemplateController@updateTemplate');
    });
});


