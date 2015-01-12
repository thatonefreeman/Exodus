<?php namespace ExpensesTracker;

use Eloquent;
use DB;

class ExpensesService extends Eloquent
{
    protected $table = 'expenses';
    protected $fillable = array('id', 'expense_category_id', 'expense_location',
                                'expense_company_name', 'expense_datetime',
                                'expense_amount', 'expense_tax', 'expense_company_bn',
                                'expense_comments', 'expense_payment_type'
                    );    
    
    /**
     * Retrieve the entire category
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('expenses as ex')
                ->join('expenses_attachment as ea', 'ex.id', '=', 'ea.expenses_id')
                ->select('ex.*', 'ea.expense_attachment_file AS expense_attachment')
                ->where('ex.id', $id)
                ->first();
    }
}