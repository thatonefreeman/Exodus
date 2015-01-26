<?php namespace System;

use App;
use View;
use Validator;
use Input;
use Redirect;
use Session;

class DatabaseController extends \BaseController
{
    public function home()
    {
        
        $database_service = new DatabaseService;
        $backups = $database_service->getCurrentBackups();
        
        return View::make('system/database')->with(array('backups' => $backups));
    }
    
    /**
     * Used via AJAX
     * @param type $database_file
     * @return boolean
     */
    public function delete($database_file)
    {
        
        $file_path = public_path('backups/' . $database_file);
        
        if(is_file($file_path))
        {
            if(unlink($file_path))
            {
                return 'File deleted.';
            }else
            {
                return 'File could not be deleted';
            }
        }
        return 'File specified is not accessible. File given: ' . $file_path;
        
    }
    
    /**
     * Executes a command based on local env. var.
     * @return mixed
     */
    public function backup()
    {
        if(App::isLocal())
        {
            // Dev Machine
            exec('F:\dev\mysql\bin\mysqldump -hlocalhost -uroot -palpha301 kc_exodus > F:\dev\htdocs\exodus\public\backups\\'.time().'-exodus-backup.sql', $output, $return_var);             
        }else
        {
            // Production / Deployment 
            $backup_file = time() . '-exodus-backup.sql';
            //$command = 'mysqldump -hlocalhost -ukeptcomp_exodus -ppH5RBLxl-x5E keptcomp_exodus 2> public_html/exodus/backups/' . $backup_file;
            $command = 'bash backup.sh';
            shell_exec($command);
        }
        
        // Command executes without error response.
        if($return_var = 0)
        {
            Session::flash('message', 'Backup was performed sucessfully. Returned with: ' . $return_var); 
            Session::flash('alert-class', 'panel-success');                        
        // Command returns 1 or sys error
        }else
        {
            Session::flash('message', 'Backup failed to execute. Try again. Call exited with status: ' . $return_var); 
            Session::flash('alert-class', 'panel-danger');                      
        }        
        
        return Redirect::to('system/database/');
        
    }
    
}