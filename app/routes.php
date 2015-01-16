<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




// Start Auth Group
Route::group(array('before' => 'auth'), function(){
    
Route::get('/', function()
{
    return View::make('dashboard');
});

/**
 * Mileage Tracker Routes
 */
Route::get('/mileagetracker', array('as' => 'mt.home', 'uses'=> 'MileageTracker\MileageTrackerController@home'));
Route::get('/mileagetracker/newentry', array('as' => 'mt.newentry', 'uses'=> 'MileageTracker\MileageTrackerController@newentry'));

/*
|--------------------------------------------------------------------------
| Mileage Tracker: Do New Entry
|--------------------------------------------------------------------------
 */
Route::post('/mileagetracker/donewentry', array('as'=>'mt.donewentry', 
    function(){
    
    $validator = Validator::make(
        array(
            'odometer_start' => Input::get('odometer_start'),
            'odometer_finish' => Input::get('odometer_finish'),
            'filling_up' => Input::get('filling_up'),
            'fuel_level' => Input::get('fuel_level'),
            'price_per_litre' => Input::get('price_per_litre'),
            'litres_purchased' => Input::get('litres_purchased'),
            'total_fuel_cost' => Input::get('total_fuel_cost'),
            'travel_reason' => Input::get('travel_reason'),
            'travel_origin' => Input::get('travel_origin'),
            'travel_destination' => Input::get('travel_destination'),
            'travel_comments' => Input::get('travel_comments'),
            'mileage_attachement' => Input::file('mileage_attachement'),
            'log_datetime' => Input::get('log_datetime'),
            'vehicle_id' => Input::get('vehicle_id')
            
        ),
        array(
            'odometer_start' => 'required|numeric',
            'odometer_finish' => 'required|numeric',
            'filling_up' => 'required|alpha',
            'fuel_level' => 'required',
            'price_per_litre' => '',
            'litres_purchased' => '',
            'total_fuel_cost' => '',
            'travel_reason' => 'required',
            'travel_origin' => 'required',
            'travel_destination' => 'required', 
            'travel_comments' => '',
            'mileage_attachement' => '',
            'vehicle_id' => 'required|numeric',
            'log_datetime' => 'required'
        ) 
    );
    
    if($validator->fails())
    {
        return Redirect::back()->withInput()->withErrors($validator);
    }else
    {
        $mileage_tracker = new MileageTrackerService();
        $mileage_tracker->odometer_start = Input::get('odometer_start');
        $mileage_tracker->odometer_finish = Input::get('odometer_finish');
        $mileage_tracker->filling_up = Input::get('filling_up');
        $mileage_tracker->fuel_level = Input::get('fuel_level');
        $mileage_tracker->price_per_litre = Input::get('price_per_litre');
        $mileage_tracker->litres_purchased = Input::get('litres_purchased');
        $mileage_tracker->total_fuel_cost = Input::get('total_fuel_cost');
        $mileage_tracker->travel_reason = Input::get('travel_reason');
        $mileage_tracker->travel_origin = Input::get('travel_origin');
        $mileage_tracker->travel_destination = Input::get('travel_destination');
        $mileage_tracker->travel_comments = Input::get('travel_comments');
        $mileage_tracker->vehicle_id = Input::get('vehicle_id');
        $mileage_tracker->log_datetime = Input::get('log_datetime');
        
        /*
         * Has an attachement been provided? If so, handle it.
         */
        if(Input::hasFile('mileage_attachment'))
        {
            $file                   = Input::file('mileage_attachment');
            $filename               = str_random(6) . '_' . $file->getClientOriginalName();
            $destination_path       = public_path().'/uploads/mileagetracker/';
            $upload_success         = Input::file('mileage_attachment')->move($destination_path, $filename);
            
            $mileage_tracker->mileage_attachement = '/uploads/mileagetracker/'.$filename;
        }
        
        if($mileage_tracker->save())
        {
            Session::flash('message', 'Your mileage entry has been successfully entered.'); 
            Session::flash('alert-class', 'panel-success');             
        }else
        {
            Session::flash('message', 'There was an error when attempting to save your entry. Please try again.'); 
            Session::flash('alert-class', 'panel-danger');             
        }

        return Redirect::route('mt.newentry');
    }


}));

/**
 * Mileage Tracker: Redirect direct viewentry routes to home.
 */
Route::get('/mileagetracker/viewentry', array( function(){
    Redirect::route('mt.home');
}));

/**
 * Mileage Tracker: View An Entry
 */
Route::get('mileagetracker/viewentry/{id}', array('as'=>'mt.viewentry', 
    function($id){
    
    $mileage_tracker = new MileageTrackerService();
    $data = $mileage_tracker->getEntry($id);
    
    if(! is_numeric($id))
    {
        trigger_error('Record ID is invalid.', E_USER_ERROR);
    }
    
    return View::make('mileagetracker/viewentry')->with('entry', $data);        
}));

/**
 * Mileage Tracker: Update Entry
 */
Route::get('mileagetracker/updateentry{id}', array('as' => 'mt.updateentry'), function(){
    
});

/**
 * Mileage Tracker: Get Vehicles 
 */
Route::get('mileagetracker/vehicles', array('as' => 'mt.vehicles', function(){

    $vehicle_service = new MileageTracker\VehicleService();
    $vehicles = $vehicle_service::all();
    
    return View::make('mileagetracker/vehicles')->with('entries', $vehicles);
    
}));


/**
 * Mileage Tracker: Delete Entry
 */
Route::get('mileagetracker/deleteentry/{id}', array('as' => 'mt.deleteentry', function($id){

    $mileage_entry = MileageTrackerService::find($id);
    $mileage_entry->delete();
    
    if($mileage_entry->trashed() == TRUE)
    {
            Session::flash('message', 'Your mileage entry has been successfully removed.'); 
            Session::flash('alert-class', 'panel-success');  
    }else
    {
            Session::flash('message', 'Your mileage entry could not be removed Please try again.'); 
            Session::flash('alert-class', 'panel-warning');  
    }
    
    return Redirect::route('mt.home');
    
}));

Route::post('mileagetracker/deleteentry/', array('as' => 'mt.deleteentry', function(){

    return View::make('mileagetracker/vehicles')->with('entries', $vehicles);
    
}));

/**
 * Mileage Tracker: Get Vehicle Entry 
 */
Route::get('mileagetracker/viewvehicle/{id}', array('as' => 'mt.viewvehicle', function($id){

    $vehicle_service = new MileageTracker\VehicleService();
    $vehicles = $vehicle_service->getEntry($id);
    $vehicle_stats = $vehicle_service->getVehicleStats($id);
    
    return View::make('mileagetracker/viewvehicle')->with(array('entry' => $vehicles, 'stats' => $vehicle_stats));
    
}));


 /******************************************************************************
 * EXPENSE TRACKER ROTUES
 ******************************************************************************/
// Home Rotue
Route::get('/expensestracker', array('as' => 'ex.home', 'uses'=> 'ExpensesTracker\ExpensesTrackerController@home'));
// New Entry Route
Route::get('/expensestracker/newentry', 'ExpensesTracker\ExpensesTrackerController@newentry');
// Do New Entry Route
Route::post('/expensestracker/donewentry', 'ExpensesTracker\ExpensesTrackerController@donewentry');
// View Entry Route
Route::get('/expensestracker/viewentry/{id}', array('as' => 'ex.viewentry', 'uses' => 'ExpensesTracker\ExpensesTrackerController@viewentry'));
// Update Entry Route
Route::post('/expensestracker/updateentry', 'ExpensesTracker\ExpensesTrackerController@updateentry');
// Delete Entry Route
Route::get('/expensestracker/deleteentry/{id}', 'ExpensesTracker\ExpensesTrackerController@deleteentry');

 /******************************************************************************
 * SYSTEM OPTIONS ROUTES
 ******************************************************************************/
Route::get('/system/database', array('uses' => 'System\DatabaseController@home'));

 /******************************************************************************
 * SUPPORT ROUTES
 ******************************************************************************/
Route::get('/support/events', array('uses' => 'Support\SupportController@getCurrentEvents'));



}); // End Auth Group



// Confide routes
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

