<?php

/**
 * Reminders Service
 * 
 * Contains all the methods required to manage and work with this component.
 */

class RemindersService extends Eloquent
{
    protected $table = 'reminders';
    
    protected $fillable = array('');
    
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getEntry($id)
    {
        return DB::table('reminders')->where('id', $id)->first();
    }
    
}