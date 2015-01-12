<?php namespace ExpensesTracker;

use Eloquent;
use DB;

class ExpensesAttachmentService extends Eloquent
{
    protected $table = 'expenses_attachment';
    protected $fillable = array('id', 'expense_attachment_file', 'expenses_id');    
    
    /**
     * Retrieve the entire category
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('expenses_attachment as ea')
                ->select('ea.*')
                ->where('ea.id', $id)
                ->first();
    }
    
    /**
     * Handles registering expense attachments to the database
     */
    public function doNewEntry()
    {
        
    }
}