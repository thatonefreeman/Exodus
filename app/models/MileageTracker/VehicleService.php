<?php namespace MileageTracker;

use Eloquent;
use DB;

class VehicleService extends Eloquent
{
    protected $table = 'vehicles';
    protected $fillable = array('id', 'vehicle_owner', 'vehicle_license_plate', 'vehicle_make_model', 'vehicle_year', 'vehicle_attachment');    
    
    /**
     * Retrieve the entire vehicle record
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('vehicles as v')
                ->select('v.*')
                ->where('v.id', $id)
                ->first();
    }
    
    /**
     * Returns an array of basic stats for a vehicle
     * @param type $id
     */
    public function getVehicleStats($id)
    {
        return DB::table('mileage_tracker')->where(array('vehicle_id' => $id, 'filling_up' => 'Yes'))->count('filling_up');
    }
    
}