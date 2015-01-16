<?php namespace MileageTracker;

 // ******************************* INFORMATION ***************************//

// ***********************************************************************//
//  
// ** MileageTrackerController
// ** 
// ** @author   Matt Fowler <mattdavidf@gmail.com>
// ** @date     Jan 15, 2015
// 
// ** This class provides the access functionality for working with the 
// ** mileage tracker component. Includes the vehicle related methods.
//      
// ***********************************************************************//

// ********************************** START ******************************// 

use View;
use Validator;
use Input;
use Redirect;
use Session;
use MileageTracker\VehicleService;
use MileageTracker\MileageTrackerService;

class MileageTrackerController extends \BaseController
{

// -----------------------------------------------------------------------// 
// Mileage tracker methods
// -----------------------------------------------------------------------//  
    
    /**
     * Builds the dashboard of the mileagetracker. Also gets some basic 
     * statistics as well.
     * @return type
     */
    public function home()
    {
        $mileage_tracker = new MileageTrackerService();
        $data = MileageTrackerService::all();
        $stats = $mileage_tracker->getStats();

        return View::make('mileagetracker/home')
                ->with(array('entries' => $data, 'stats' => $stats));        
    }
    
    public function newentry()
    {
        $available_vehicles = new VehicleService();
        return View::make('mileagetracker/newentry')
                ->with('available_vehicles', $available_vehicles);        
    }    
    
    public function viewentry($id)
    {
        
    }
    
    public function updateentry($id)
    {
        
    }
    
    public function deleteentry($id)
    {
        
    }    
    
// =======================================================================// 
// Vehicle related methods now follow.
// =======================================================================//  
    
    public function viewvehicles()
    {
        
    }
    
    public function updatevehicle()
    {
        
    }
    
    public function deletevehicle()
    {
        
    }

    
}