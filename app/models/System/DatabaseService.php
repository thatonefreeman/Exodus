<?php namespace System;

use App;

class DatabaseService
{

    private $backup_path = 'backups';
    
    /**
     * Gets a current list of cronjob backup files and returns them as an array
     * @return boolean
     */
    public function getCurrentBackups()
    {
        
        if(is_dir(public_path() . '/' . $this->backup_path))
        {
            $directory_contents = array_diff(scandir(public_path() . '/' . $this->backup_path), array('..', '.'));

            if($directory_contents !== FALSE)
            {
                return $directory_contents;
            }                        
        }

        return FALSE;
    }
    
}