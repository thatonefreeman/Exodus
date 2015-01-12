<?php namespace ExpensesTracker;

use Eloquent;
use DB;

class ExpenseCategoriesService extends Eloquent
{
    protected $table = 'expenses_category';
    protected $fillable = array('id', 'expense_category_name', 'expense_category_description');    
    
    /**
     * Retrieve the entire category
     * @param type $id
     * @return type
     */
    public function getEntry($id)
    {
        return DB::table('expenses_cateogry as ec')
                ->select('ec.*')
                ->where('ec.id', $id)
                ->first();
    }
    
    public function getAvailableCategories()
    {
        return DB::table('expenses_category')->orderBy('expense_category_name')->lists('expense_category_name', 'id');
    }
    
    
}