<?php

/**
 * Mileage Tracker Service 
 * 
 * Contains all the methods required to manage and work with this component.
 */

class MileageTrackerService extends Eloquent
{
    protected $table = 'mileage_tracker';
    protected $fillable = array('odometer_start', 'odometer_finish', 
        'filling_up', 'fuel_level', 'price_per_litre', 'litres_purchased', 
        'total_fuel_cost', 'travel_reason', 'travel_origin', 
        'travel_destination', 'travel_comments', 'mileage_attachement', 'vehicle_id' );
    
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Retrieve the entire log and the vehicle information as well.
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('mileage_tracker as mt')
                ->join('vehicles as v', 'mt.vehicle_id', '=', 'v.id')
                ->select('mt.*', 'v.vehicle_license_plate AS license')
                ->where('mt.id', $id)
                ->first();
    }
    
    /**
     * Retrieve sums of rows to use in the overview page.
     */
    public function getStats()
    {
        $stats = array();
        $stats['total_entries'] = DB::table('mileage_tracker')->count();
        $stats['odometer_start_sum'] = DB::table('mileage_tracker')->sum('odometer_start');
        $stats['odometer_finish_sum'] = DB::table('mileage_tracker')->sum('odometer_finish');
        $stats['total_litres_purchased'] = DB::table('mileage_tracker')->sum('litres_purchased');
        $stats['average_fuel_price'] = DB::table('mileage_tracker')->where('filling_up', '=','Yes')->avg('price_per_litre');
        $stats['fill_ups'] = DB::table('mileage_tracker')->where('filling_up', '=', 'Yes')->count('filling_up');
                
        
        return $stats;
    }
    
    
    
}