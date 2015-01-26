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

    private $vehicle_service_instance;
    private $mileage_tracker_service_instance;
    
    public function __construct()
    {
        $this->vehicle_service_instance = new VehicleService();
        $this->mileage_tracker_service_instance = new MileageTrackerService();
    }
    
// -----------------------------------------------------------------------// 
// Mileage tracker methods
// -----------------------------------------------------------------------//  
    
    /**
     * Builds the dashboard of the mileagetracker. Also gets some basic 
     * statistics.
     * @return type
     */
    public function home()
    {
        // User has pressed the show trash button
        if(Input::get('show_deleted_form') == 'submitted')
        {
            // If show, set session var and do query
            if(Input::get('show_deleted') == 1)
            {
                Session::put('show_deleted', 'yes');
                $data = MileageTrackerService::withTrashed()->paginate(15);  
                
            }elseif(Input::get('show_deleted') == 0)
            {
                Session::put('show_deleted', 'no');
                $data = MileageTrackerService::paginate(15);                    
            }    
        }elseif(Session::get('show_deleted') == 'yes')
        {
                Session::put('show_deleted', 'yes');
                $data = MileageTrackerService::withTrashed()->paginate(15);             
        }elseif(Session::get('show_deleted') == 'no')
        {
            Session::put('show_deleted', 'no');
            $data = MileageTrackerService::paginate(15);                    
        }else
        {
            Session::put('show_deleted', 'no');
            $data = MileageTrackerService::paginate(15);            
        }
        
        $stats = $this->mileage_tracker_service_instance
                ->getStats();

        return View::make('mileagetracker/home')
                ->with(array('entries' => $data, 'stats' => $stats));        
    }
    
    /**
     * Make the new entry form and provide it with the vehicles available.
     * @return type
     */
    public function newentry()
    {
        $available_vehicles = $this->vehicle_service_instance
                ->getAvailableVehicles();
        
        return View::make('mileagetracker/newentry')
                ->with('available_vehicles', $available_vehicles);        
    }    
    
    /**
     * 
     * @return type
     */
    public function donewentry()
    {
        $validator = $this->_validateMileageEntry();
        
        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }else
        {
            
            if($this->_saveMileageModel($this->mileage_tracker_service_instance))
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
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function viewentry($id)
    {
        $data = $this->mileage_tracker_service_instance
                ->getEntry($id);

        if(! is_numeric($id))
        {
            trigger_error('Record ID is invalid.', E_USER_ERROR);
        }

        return View::make('mileagetracker/viewentry')->with('entry', $data);                
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function updateentry($id)
    {
        $validate = $this->_validateMileageEntry();        
        
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
            
        }else
        {
            $mileage_tracker = new MileageTrackerService();
            $entry = $mileage_tracker::find($id);
            
            if($this->_saveMileageModel($entry))
            {
                Session::flash('message', 'Your mileage entry has been successfully updated.'); 
                Session::flash('alert-class', 'panel-success');                        
            }else
            {
                Session::flash('message', 'Your mileage entry failed to update. Please try again later.'); 
                Session::flash('alert-class', 'panel-danger');                      
            }
            
            return Redirect::to('mileagetracker/viewentry/' . $id);
            
        }        
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function deleteentry($id)
    {
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
    }    
    
    
    public function forcedeleteentry($id)
    {
        $mileage_entry = MileageTrackerService::withTrashed()->find($id);
        
        if($mileage_entry->forceDelete() !== FALSE)
        {
                Session::flash('message', 'Your mileage entry has been forcefully removed.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your mileage entry could not be removed. Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::route('mt.home');           
    }
    
    public function restoreentry($id)
    {
        $mileage_entry = MileageTrackerService::withTrashed()->find($id);
        
        if($mileage_entry->restore() !== FALSE)
        {
                Session::flash('message', 'Your mileage entry has been restored successfully.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your mileage entry could not be restored. Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::to('mileagetracker/viewentry/' . $id);     
    }
        
    
    
// -----------------------------------------------------------------------// 
// Vehicle methods.
// -----------------------------------------------------------------------//  
    
    /**
     * 
     * @return type
     */
    public function vehicles()
    {
        $vehicle_service = new VehicleService();
        $vehicles = $vehicle_service::all();

        return View::make('mileagetracker/vehicles')->with('entries', $vehicles);        
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function viewvehicle($id)
    {
        $vehicles = $this->vehicle_service_instance
                ->getEntry($id);
        $vehicle_stats = $this->vehicle_service_instance
                ->getVehicleStats($id);

        return View::make('mileagetracker/viewvehicle')
                ->with(array('entry' => $vehicles, 'stats' => $vehicle_stats));        
    }
    
    public function updatevehicle()
    {
        
    }
    
    public function deletevehicle()
    {
        
    }

    
// =======================================================================// 
// UTILITY METHODS
// =======================================================================//  
    
    /**
     * Runs validation methods on the expense model.
     * @return validator
     */
    private function _validateMileageEntry()
    {
        
        Validator::extend('not_greater_than', function($attribute, $value, $parameters)
        {
            
            if($attribute > Input::get($parameters[0]))
            {
                return FALSE;
            }
            
            return TRUE;
        });        
        
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
                'odometer_start' => 'required|numeric|not_greater_than:odometer_finish',
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
            ),
            array(
                'not_greater_than' => 'The :attribute field cannot be larger than the odometer finish field.',
            )
        );
        
        return $validator;
        
    }
    
    /**
     * Saves the expense data to the Eloquent model.
     */
    private function _saveMileageModel(MileageTrackerService $mileage_tracker)
    {
        
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
        
        return $mileage_tracker->save();
        
    }    
    
}