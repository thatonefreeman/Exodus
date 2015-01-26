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
                                'expense_comments', 'expense_payment_type',
                                'created_at', 'updated_at', 'deleted_at'
                    );    
    
    /**
     * Retrieve the entire category
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('expenses as ex')
                //->leftjoin('expenses_attachment as ea', 'ex.id', '=', 'ea.expenses_id')
                //->select('ex.*', 'ea.expense_attachment_file AS expense_attachment')
                ->where('ex.id', $id)
                ->first();
    }
    
    /**
     * 
     * @return type
     */
    public function getAll($params)
    {
        
        if(isset($params['show_deleted']) && $params['show_deleted'] == TRUE)
        {
            return DB::table('expenses as ex')
                    ->join('expenses_category as ec', 'ex.expense_category_id', '=', 'ec.id')
                    ->select('ex.*', 'ec.expense_category_name AS expense_category')
                    ->paginate(15);            
        }
        
        return DB::table('expenses as ex')
                ->where('ex.deleted_at', '=', NULL)
                ->join('expenses_category as ec', 'ex.expense_category_id', '=', 'ec.id')
                ->select('ex.*', 'ec.expense_category_name AS expense_category')
                ->paginate(15);        
    }        
    
    public function getExpensesByCategory($id, $limit = 0)
    {
        return DB::table('expenses as ex')
                ->where('ex.deleted_at', '=', NULL)
                ->join('expenses_category as ec', 'ex.expense_category_id', '=', 'ec.id')
                ->select('ex.*', 'ex.id AS expense_id')
                ->where('ec.id', '=', $id)
                ->orderby('ex.expense_datetime', 'DESC')
                ->limit($limit)
                ->get();        
    }
    
    /**
     * Gets a series of sums and averages for the category.
     * @param type $id
     */
    public function getCategoryStats($id)
    {
        $stats = array();
        
        $stats['total_entries'] = DB::table('expenses')
                ->where('deleted_at', null)
                ->where('expense_category_id', $id)
                ->count();        
        $stats['total_spent'] = DB::table('expenses')
                ->where('deleted_at', null)
                ->where('expense_category_id', $id)
                ->sum('expense_amount');
        $stats['total_tax'] = DB::table('expenses')
                ->where('deleted_at', null)
                ->where('expense_category_id', $id)
                ->sum('expense_tax'); 
        
        return $stats;
    }
    
}