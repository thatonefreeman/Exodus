<?php namespace ExpensesTracker;

use View;
use Validator;
use Input;
use Redirect;
use ExpensesTracker\ExpensesAttachmentService;

class ExpensesTrackerController extends \BaseController
{
    
    public function __construct()
    {
        $this->beforeFilter('guest',['only' => ['getLogin']]);
        $this->beforeFilter('auth',['only' => ['getLogout']]);        
    }
    
    /**
     * Display an overview of the extenses
     */
    public function home()
    {
        $expenses_tracker = new ExpensesService();
        $data = ExpensesService::all();
       
        return View::make('expensestracker/home')->with(array('entries' => $data));
    }
    
    /**
     * Creates the new entry form
     */
    public function newentry()
    {
        $expense_categories = new ExpenseCategoriesService;
        
        return View::make('expensestracker/newentry')->with('available_categories', $expense_categories->getAvailableCategories());
    }
    
    /**
     * Processes data for a new entry
     */
    public function donewentry()
    {
        $validator = Validator::make(
            array(
                'expense_category_id' => Input::get('expense_category_id'),
                'expense_location' => Input::get('expense_location'),
                'expense_company_name' => Input::get('expense_company_name'),
                'expense_datetime' => Input::get('expense_datetime'),
                'expense_amount' => Input::get('expense_amount'),
                'expense_tax' => Input::get('expense_tax'),
                'expense_company_bn' => Input::get('expense_company_bn'),
                'expense_comments' => Input::get('expense_comments'),
                'expense_payment_type' => Input::get('expense_payment_type'),
            ),
            array(
                'expense_category_id' => 'required|numeric',
                'expense_location' => 'required',
                'expense_company_name' => 'required',
                'expense_datetime' => 'required',
                'expense_amount' => 'required',
                'expense_tax' => 'required',
                'expense_company_bn' => 'required',
                'expense_comments' => '',
                'expense_payment_type' => 'required',
            )
        );

        if($validator->fails())
        {
            //return View::make('mileagetracker/newentry');        
            echo '<pre>';
            print_r($messages = $validator->messages());
            echo '</pre>';
        }else
        {
            $expenses_tracker = new ExpensesService();
            $expenses_tracker->expense_category_id = Input::get('expense_category_id');
            $expenses_tracker->expense_location = Input::get('expense_location');
            $expenses_tracker->expense_company_name = Input::get('expense_company_name');
            $expenses_tracker->expense_datetime = Input::get('expense_datetime');
            $expenses_tracker->expense_amount = Input::get('expense_amount');
            $expenses_tracker->expense_tax = Input::get('expense_tax');
            $expenses_tracker->expense_company_bn = Input::get('expense_company_bn');
            $expenses_tracker->expense_comments = Input::get('expense_comments');
            $expenses_tracker->expense_payment_type = Input::get('expense_payment_type');
            $expenses_tracker->save();
            
            /*
             * Has an attachement been provided? If so, handle it.
             */
            if(Input::hasFile('expense_attachment'))
            {
                $file                   = Input::file('expense_attachment');
                $filename               = str_random(6) . '_' . $file->getClientOriginalName();
                $destination_path       = public_path().'/uploads/expensestracker/';
                $upload_success         = Input::file('expense_attachment')->move($destination_path, $filename);

                $expenses_attachment = new ExpensesAttachmentService();
                $expenses_attachment->expenses_id = $expenses_tracker->id;
                $expenses_attachment->expense_attachment_file = '/uploads/expensestracker/'.$filename;
                $expenses_attachment->save();
                
            }

            return Redirect::to('expensestracker/newentry');
        }        
    }
    
    /**
     * 
     */
    public function viewentry($id)
    {
        $expenses_tracker = new ExpensesService();
        $expense_categories = new ExpenseCategoriesService();
        $available_categories = $expense_categories->getAvailableCategories();
        
        $data = $expenses_tracker->getEntry($id);
    
        if(! is_numeric($id))
        {
            trigger_error('Record ID is invalid.', E_USER_ERROR);
        }
    
        return View::make('expensestracker/viewentry')->with(array('entry' => $data, 'available_categories' => $available_categories));        
    }
    
    /**
     * 
     */
    public function updateentry()
    {
        
    }
    
    /**
     * 
     */
    public function deleteentry()
    {
        
    }
    
    
    
    
    
}