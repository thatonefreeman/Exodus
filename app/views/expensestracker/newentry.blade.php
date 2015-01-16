@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>New Entry</small>
    </h1>
</section>
<hr>


    {{ Form::open(array('url' => 'expensestracker/donewentry', 'files'=>true)) }}
    
    <section class="content">
        <div class="col-md-6">
            <div class="row-fluid">
                <legend><h3>Purchase Information</h3></legend> 

                <div class="col-md-6 col-xs-12">
                    <label>Company Name</h3></label>
                    {{ Form::text('expense_company_name', '', ['class' => 'form-control']) }}
                </div>        
                
                <div class="col-md-6 col-xs-12">
                    <label>Purchase Location</label>
                    {{ Form::text('expense_location','', ['class' => 'form-control']) }}
                </div>                           
                
                <div class="col-md-6 col-xs-12">
                    <label>Expense Category</label>
                    {{ Form::select('expense_category_id',
                                array('Select Expense Category' => 'Select Expense Category','Available Categories' => $available_categories),
                                'Select Expense Category',
                                ['class'=>'form-control'])  
                    }}
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Purchase Date / Time</label>
                          <div class='input-group date' id='expense_datetime'>
                              <input type='text' name="expense_datetime" class="form-control" readonly=""/>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>                 
                    </div>                    
                </div>                
            </div>              
        </div>
    </section>  
    
    <section class="content">
        <div class="row-fluid">
            <div class="col-md-6 col-xs-12">
                <legend><h3>Purchase Details</h3></legend>
                <p>If using split payment, specify "Other" as the payment
                method and provide the split details in the comments.</p>
                
                <div class="col-md-6 col-xs-12">
                    <label>Company Business Number</label>
                    {{ Form::text('expense_company_bn', '', ['class' => 'form-control']) }}
                </div>       
                <div class="col-md-6 col-xs-12">
                    <label>Expense Subtotal (56.99)</label>
                    {{ Form::number('expense_amount', '', ['class' => 'form-control','step' => '000.01']) }}
                </div>                      
                <div class="col-md-6 col-xs-12">
                    <label>Expense Tax Amount (10.25)</label>
                    {{ Form::number('expense_tax', '', ['class' => 'form-control', 'step' => '000.01']) }}
                </div>                      
                <div class="col-md-6 col-xs-12">
                    <label>Payment Method</label>
                    {{ Form::select('expense_payment_type',
                                array('Select Payment Type' => 'Select Payment Type',
                                       'Cash' => 'Cash',
                                       'Credit Card' => 'Credit Card',
                                       'eTransfer' => 'eTransfer',
                                       'Debit Card' => 'Debit Card',
                                       'Gift Card' => 'Gift Card',
                                       'Store Credit' => 'Store Credit',
                                       'Other' => 'Other'),
                                'Select Payment Type',
                                ['class'=>'form-control'])  
                    }}                    
                </div>                      
            </div>  
        </div>
    </section>    
    
    <section class="content">
        <div class="row-fluid">
            <legend><h3>Proof of Purchase</h3></legend>
            <div class="col-md-6 col-xs-12">
                <label>Receipt Picture</label>
                {{ Form::file('expense_attachment', ['class' => 'form-control', 'accept'=>'image/*']) }}
            </div>  
        </div>
    </section>
    
    <section class="content">
        <div class="row-fluid">
            <div class="col-md-6 col-xs-12">
                <label>Expense Comments</label>
                {{ Form::textarea('expense_comments', '',['class' => 'form-control', 'placeholder' => 'Expense Comments', 'rows'=>4]) }}
            </div>
        </div>        
    </section>
    
    <section class="content">
        <div class="row-fluid">
            <div class="panel panel-info">
                <div class="panel-heading">Available Actions</div>
                <div class="panel-body">
                    <div class="col-md-2 col-xs-6">
                        <input type="submit" class="btn btn-flat btn-success" value="Submit Expense Report">
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <a href="#" class="btn btn-flat btn-danger">Cancel Entry</a>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    
    {{ Form::close() }}

@stop