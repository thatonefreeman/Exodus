<?php

// ******************************* INFORMATION ***************************//

// ***********************************************************************//
//  
// ** Routes    - Exodus system routes
// ** 
// ** @author   Matt Fowler <mattdavidf@gmail.com>
// ** @date     Jan 15, 2015
//      
// ***********************************************************************//

// ********************************** START ******************************// 


/******************************************************************************
 * AUTHENTICATION GROUP
 ******************************************************************************/   
Route::group(array('before' => 'auth'), function(){
    
/******************************************************************************
 * SYSTEM WIDE ROUTING
 ******************************************************************************/    
    // Make main system dashboard
    Route::get('/', function()
    {
        return View::make('dashboard');
    });

 /******************************************************************************
 * MILEAGE TRACKER ROUTES
 ******************************************************************************/    
    // Mileage Tracker Dashboard/Home
    Route::any('/mileagetracker', array('as' => 'mt.home', 'uses'=> 'MileageTracker\MileageTrackerController@home'));
    
    // New entry form
    Route::get('/mileagetracker/newentry', array('as' => 'mt.newentry', 'uses'=> 'MileageTracker\MileageTrackerController@newentry'));
    // Do new entry
    Route::post('/mileagetracker/donewentry', array('as'=>'mt.donewentry', 'uses' => 'MileageTracker\MileageTrackerController@donewentry'));
    // Prevent a direct view without id
    Route::get('/mileagetracker/viewentry', array( function(){ Redirect::route('mt.home'); }));
    // View entry
    Route::get('mileagetracker/viewentry/{id}', array('as'=>'mt.viewentry', 'uses' => 'MileageTracker\MileageTrackerController@viewentry'));
    // Update Entry
    Route::post('mileagetracker/updateentry/{id}', array('as' => 'mt.updateentry', 'uses' => 'MileageTracker\MileageTrackerController@updateentry'));
    // View vehicles
    Route::get('mileagetracker/vehicles', array('as' => 'mt.vehicles', 'uses' => 'MileageTracker\MileageTrackerController@vehicles'));
    // Delete Entry
    Route::get('mileagetracker/deleteentry/{id}', array('as' => 'mt.deleteentry', 'uses' => 'MileageTracker\MileageTrackerController@deleteentry'));
    // Delete Entry (Forcefully)
    Route::get('mileagetracker/forcedeleteentry/{id}', array('as' => 'mt.deleteentry', 'uses' => 'MileageTracker\MileageTrackerController@forcedeleteentry'));
    // Restore Entry
    Route::get('mileagetracker/restoreentry/{id}', array('as' => 'mt.deleteentry', 'uses' => 'MileageTracker\MileageTrackerController@restoreentry'));    
    // View vehicle
    Route::get('mileagetracker/viewvehicle/{id}', array('as' => 'mt.viewvehicle', 'uses' => 'MileageTracker\MileageTrackerController@viewvehicle'));

 /******************************************************************************
 * EXPENSE TRACKER ROTUES
 ******************************************************************************/
    // Home Rotue
    Route::any('/expensestracker', array('as' => 'ex.home', 'uses'=> 'ExpensesTracker\ExpensesTrackerController@home'));
    
    // New Entry Route
    Route::get('/expensestracker/newentry', 'ExpensesTracker\ExpensesTrackerController@newentry');
    // Do New Entry Route
    Route::post('/expensestracker/donewentry', 'ExpensesTracker\ExpensesTrackerController@donewentry');
    // View Entry Route
    Route::get('/expensestracker/viewentry/{id}', array('as' => 'ex.viewentry', 'uses' => 'ExpensesTracker\ExpensesTrackerController@viewentry'));
    // Update Entry Route
    Route::post('/expensestracker/updateentry/{id}', 'ExpensesTracker\ExpensesTrackerController@updateentry');
    // Delete Entry Route
    Route::get('/expensestracker/deleteentry/{id}', 'ExpensesTracker\ExpensesTrackerController@deleteentry');
    // Force Delete Entry Route
    Route::get('/expensestracker/forcedeleteentry/{id}', 'ExpensesTracker\ExpensesTrackerController@forcedeleteentry');
    // Restore Entry Route
    Route::get('/expensestracker/restoreentry/{id}', 'ExpensesTracker\ExpensesTrackerController@restoreentry');
    
 /******************************************************************************
 * EXPENSE TRACKER CATEGORY ROUTES
 ******************************************************************************/
    // View Expense Categories Route
    Route::get('/expensestracker/viewcategories', array('as' => 'ex.viewcategories', 'uses' => 'ExpensesTracker\ExpensesTrackerController@viewcategories'));
    // View Expense Category Route
    Route::get('/expensestracker/viewcategory/{id}', array('as' => 'ex.viewcategory', 'uses' => 'ExpensesTracker\ExpensesTrackerController@viewcategory'));
    // Do New Expense Category Route
    Route::post('/expensestracker/donewcategory', array('as' => 'ex.donewcategory', 'uses' => 'ExpensesTracker\ExpensesTrackerController@donewcategory'));
    // Update Expense Category Route
    Route::post('/expensestracker/updatecategory/{id}', array('as' => 'ex.updatecategory', 'uses' => 'ExpensesTracker\ExpensesTrackerController@updatecategory'));
    // Update Expense Category Route
    Route::get('/expensestracker/deletecategory/{id}', array('as' => 'ex.updatecategory', 'uses' => 'ExpensesTracker\ExpensesTrackerController@deletecategory'));

 /******************************************************************************
 * SYSTEM OPTIONS ROUTES
 ******************************************************************************/
    // View database overview
    Route::get('/system/database', array('uses' => 'System\DatabaseController@home'));
    // Execute database delete - used via AJAX
    Route::post('/system/database/delete/{file}', array('as' => 'system.database.delete', 'uses' => 'System\DatabaseController@delete'));    
    // Execute database backup - used via AJAX
    Route::any('/system/database/backup/', array('as' => 'system.database.backup', 'uses' => 'System\DatabaseController@backup'));    

 /******************************************************************************
 * SUPPORT ROUTES
 ******************************************************************************/
    // Not currently used.
    Route::get('/support/events', array('uses' => 'Support\SupportController@getCurrentEvents'));

}); // End Auth Group

 /******************************************************************************
 * CONFIDE ROUTING
 ******************************************************************************/
    Route::get('login', 'UsersController@login');
    Route::post('login', 'UsersController@doLogin');

    Route::get('users/create', 'UsersController@create');
    Route::post('users', 'UsersController@store');

    Route::get('users/login', 'UsersController@login');
    Route::post('users/login', 'UsersController@doLogin');

    Route::get('users/confirm/{code}', 'UsersController@confirm');
    Route::get('users/forgot_password', 'UsersController@forgotPassword');
    Route::post('users/forgot_password', 'UsersController@doForgotPassword');
    Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
    Route::post('users/reset_password', 'UsersController@doResetPassword');
    Route::get('users/logout', 'UsersController@logout');

