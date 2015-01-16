<?php namespace System;

use View;
use Validator;
use Input;
use Redirect;

class DatabaseController extends \BaseController
{
    public function home()
    {
        
        $database_service = new DatabaseService;
        $backups = $database_service->getCurrentBackups();
        
        return View::make('system/database')->with(array('backups' => $backups));
    }
    
}