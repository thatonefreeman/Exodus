<?php namespace ExpensesTracker;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


use Eloquent;
use DB;

class ExpensesService extends Eloquent
{
    
    use SoftDeletingTrait;
    
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
    
    /**
     * 
     * @return type
     */
    public function getAll()
    {
        return DB::table('expenses as ex')
                ->join('expenses_attachment as ea', 'ex.id', '=', 'ea.expenses_id')
                ->join('expenses_category as ec', 'ex.expense_category_id', '=', 'ec.id')
                ->select('ex.*', 'ea.expense_attachment_file AS expense_attachment', 'ec.expense_category_name AS expense_category')
                ->where('ex.deleted_at', null)
                ->get();
    }        
}