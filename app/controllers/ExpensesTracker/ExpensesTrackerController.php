<?php namespace ExpensesTracker;

 // ******************************* INFORMATION ***************************//

// ***********************************************************************//
//  
// ** ExpensesTrackerController
// ** 
// ** @author   Matt Fowler <mattdavidf@gmail.com>
// ** @date Jan 17 2015
// 
// ** Works with the ExpenseTracker component. Includes methods for expense
// ** CRUD and expense category CRUD.
//      
// ***********************************************************************//

// ********************************** START ******************************// 

use View;
use Validator;
use Input;
use Redirect;
use Session;
use ExpensesTracker\ExpensesAttachmentService;
use ExpensesTracker\ExpenseCategoriesService;
use ExpensesTracker\ExpensesService;

class ExpensesTrackerController extends \BaseController
{
    
    private $expenses_categories_instance;
    
    public function __construct()
    {
        $this->beforeFilter('guest',['only' => ['getLogin']]);
        $this->beforeFilter('auth',['only' => ['getLogout']]);     
        
        $this->expenses_categories_instance = new ExpenseCategoriesService;
        
    }
    
    /**
     * Display an overview of the extenses
     */
    public function home()
    {
        // If the user wants to see deleted records, set the var in the session
        // and also reexecute the query.
        $params = array();
                
        $expenses_tracker = new ExpensesService();
        
        // User has pressed the show trash button
        if(Input::get('show_deleted_form') == 'submitted')
        {
            // If show, set session var and do query
            if(Input::get('show_deleted') == 1)
            {
                Session::put('show_deleted', 'yes');
                $params['show_deleted'] = TRUE;
                
            }elseif(Input::get('show_deleted') == 0)
            {
                Session::put('show_deleted', 'no');
                $params['show_deleted'] = FALSE;
            }    
        }elseif(Session::get('show_deleted') == 'yes')
        {
            Session::put('show_deleted', 'yes');
            $params['show_deleted'] = TRUE;
        }elseif(Session::get('show_deleted') == 'no')
        {
            Session::put('show_deleted', 'no');
            $params['show_deleted'] = FALSE;
        }
        
        $data = $expenses_tracker->getAll($params);    
        
        return View::make('expensestracker/home')
                ->with(array('entries' => $data, 'expense_categories' => $this->expenses_categories_instance
                ->getAvailableCategories()));
    }
    
    /**
     * Creates the new entry form
     */
    public function newentry()
    {
        $expense_categories = new ExpenseCategoriesService;
        
        return View::make('expensestracker/newentry')
                ->with('available_categories', $expense_categories->getAvailableCategories());
    }
    
    /**
     * Process the expense entry
     * @return mixed
     */
    public function donewentry()
    {
        
        $validate = $this->_validateExpenseEntry();
        
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
        }else
        {
            /**
             * Save the expense data to Eloquent model.
             */
            $expenses_tracker = new ExpensesService();
            $this->_saveExpenseModel($expenses_tracker);
            
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
        $expense_attachments = new ExpensesAttachmentService();
        $available_categories = $expense_categories->getAvailableCategories();
        
        
        $data = $expenses_tracker->getEntry($id);
    
        if(! is_numeric($id))
        {
            trigger_error('Record ID is invalid.', E_USER_ERROR);
        }
    
        return View::make('expensestracker/viewentry')
                ->with(array('entry' => $data, 
                    'available_categories' => $available_categories, 
                    'attachments' => $expense_attachments->getAllAttachmentsForExpense($id)
                ));        
    }
    
    /**
     * 
     */
    public function updateentry($id)
    {
        $validate = $this->_validateExpenseEntry();        
        
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
            
        }else
        {
            $expenses_tracker = new ExpensesService();   
            
            $entry = $expenses_tracker::find($id);
            
            if($this->_saveExpenseModel($entry))
            {
                Session::flash('message', 'Your expense entry has been successfully updated.'); 
                Session::flash('alert-class', 'panel-success');                        
            }else
            {
                Session::flash('message', 'Your expense entry failed to update. Please try again later.'); 
                Session::flash('alert-class', 'panel-danger');                      
            }
            
            return Redirect::to('expensestracker/viewentry/' . $id);
            
        }
        
    }
    
    /**
     * 
     */
    public function deleteentry($id)
    {
        $expenses_entry = ExpensesService::find($id);
        $expenses_entry->delete();

        
        if($expenses_entry->trashed() == TRUE)
        {
                Session::flash('message', 'Your mileage entry has been successfully removed.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your mileage entry could not be removed Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::route('ex.home');        
    }

    public function forcedeleteentry($id)
    {
        $expense_entry = ExpensesService::withTrashed()->find($id);
        
        if($expense_entry->forceDelete() !== FALSE)
        {
                Session::flash('message', 'Your expense entry has been forcefully removed.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your expense entry could not be removed. Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::route('ex.home');           
    }
    
    public function restoreentry($id)
    {
        $expense_entry = ExpensesService::withTrashed()->find($id);
        
        if($expense_entry->restore() !== FALSE)
        {
                Session::flash('message', 'Your expense entry has been restored successfully.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your expense entry could not be restored. Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::to('expensestracker/viewentry/' . $id);     
    }    
    
    
 
// -----------------------------------------------------------------------// 
// Expense Category Methods
// -----------------------------------------------------------------------//      
    
    /**
     * Provides the category home page.
     * @return type
     */
    public function viewcategories()
    {
        
        $entries = ExpenseCategoriesService::all();
        
        return View::make('expensestracker/viewcategories')->with('entries', $entries);
        
    }
    
    /**
     * Processes the new category information
     * @return type
     */
    public function donewcategory()
    {
        
        $validate = $this->_validateCategoryModel();
        
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
        }else
        {
            /**
             * Save the category data to Eloquent model.
             */
            if($this->_saveCategoryModel($this->expenses_categories_instance))
            {
                    Session::flash('message', 'Your expense category has been successfully added.'); 
                    Session::flash('alert-class', 'panel-success');  
            }else
            {
                    Session::flash('message', 'Your expense category could not be saved. Please try again.'); 
                    Session::flash('alert-class', 'panel-danger');  
            }            

            return Redirect::to('expensestracker/viewcategories');
        }            
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function viewcategory($id)
    {
        $entry = ExpenseCategoriesService::find($id);
        $category_expenses = new ExpensesService();
        
        return View::make('expensestracker/viewcategory')->with(array(
            'entry' => $entry, 
            'category_expenses' => $category_expenses->getExpensesByCategory($id, 10),
            'stats' => $category_expenses->getCategoryStats($id)));
    }
    
    /**
     * 
     * @param type $id
     */
    public function updatecategory($id)
    {
        $validate = $this->_validateCategoryModel();        
        
        if($validate->fails())
        {
            return Redirect::back()->withInput()->withErrors($validate);
            
        }else
        {
            $expense_category = new ExpenseCategoriesService();
            
            $entry = $expense_category::find($id);
            
            if($this->_saveCategoryModel($entry))
            {
                Session::flash('message', 'Your expense category has been successfully updated.'); 
                Session::flash('alert-class', 'panel-success');                        
            }else
            {
                Session::flash('message', 'Your expense category failed to update. Please try again later.'); 
                Session::flash('alert-class', 'panel-warning');                      
            }

            return Redirect::to('expensestracker/viewcategory/' . $id);
            
        }        
    }
    
    public function deletecategory($id)
    {
        $expense_category = ExpenseCategoriesService::find($id);
        $expense_category->delete();

        if($expense_category->trashed() == TRUE)
        {
                Session::flash('message', 'Your expense category has been successfully removed.'); 
                Session::flash('alert-class', 'panel-success');  
        }else
        {
                Session::flash('message', 'Your expense category could not be removed Please try again.'); 
                Session::flash('alert-class', 'panel-warning');  
        }

        return Redirect::route('ex.viewcategories');         
    }
    
    
// -----------------------------------------------------------------------// 
// Utility Methods
// -----------------------------------------------------------------------//    
    
    /**
     * Runs validation methods on the expense model.
     * @return validator
     */
    private function _validateExpenseEntry()
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
                'expense_attachment' => Input::file('expense_attachment'),
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
                'expense_attachment' => '',
            )
        );        
        
        return $validator;
        
    }

    /**
     * Saves the expense data to the Eloquent model.
     * 
     * @param \ExpensesTracker\ExpensesService $expenses_tracker
     * @return type
     */
    private function _saveExpenseModel(\ExpensesTracker\ExpensesService $expenses_tracker)
    {
        
        $expenses_tracker->expense_category_id = Input::get('expense_category_id');
        $expenses_tracker->expense_location = Input::get('expense_location');
        $expenses_tracker->expense_company_name = Input::get('expense_company_name');
        $expenses_tracker->expense_datetime = Input::get('expense_datetime');
        $expenses_tracker->expense_amount = Input::get('expense_amount');
        $expenses_tracker->expense_tax = Input::get('expense_tax');
        $expenses_tracker->expense_company_bn = Input::get('expense_company_bn');
        $expenses_tracker->expense_comments = Input::get('expense_comments');
        $expenses_tracker->expense_payment_type = Input::get('expense_payment_type');

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
        
        
        return $expenses_tracker->save();        
        
    }
    
// -----------------------------------------------------------------------// 
// Utility Methods: Categories
// -----------------------------------------------------------------------//        
    
    private function _validateCategoryModel()
    {
        $validator = Validator::make(
            array(
                'expense_category_name' => Input::get('expense_category_name'),
                'expense_category_description' => Input::get('expense_category_description'),
            ),
            array(
                'expense_category_name' => 'required',
                'expense_category_description' => 'required',
            )
        );        
        
        return $validator;        
    }
    
    private function _saveCategoryModel($category_service)
    {
        $category_service->expense_category_name = Input::get('expense_category_name');
        $category_service->expense_category_description = Input::get('expense_category_description');

        return $category_service->save();                
    }
    
    
}