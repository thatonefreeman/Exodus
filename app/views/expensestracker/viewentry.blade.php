@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>Viewing Entry</small>
    </h1>
</section>
<hr>

@if(Session::has('message'))
    <section class="content">
        <div class="panel {{ Session::get('alert-class', 'panel-info')}}">
            <div class="panel-heading">Message</div>
            <div class="panel-body">
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>    
    </section>
@endif       
@if(count($errors) > 0)
    <section class="content">
        <div class="panel panel-danger">
            <div class="panel-heading"><strong>Submission Errors Detected</strong></div>
            <div class="panel-body">
                <ul>
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
                </ul>
            </div>
        </div>
    </section>
@endif

{{ Form::open(array('url' => 'expensestracker/updateentry/'. $entry->id, 'files'=>true)) }}
    
<section class="content">
    <div class="col-md-6">
        <div class="row-fluid">
            <legend><h3>Purchase Information</h3></legend>          

            <div class="col-md-6 col-xs-12">
                <label>Company Name</h3></label>
                {{ Form::text('expense_company_name', $entry->expense_company_name, ['class' => 'form-control']) }}
            </div>        

            <div class="col-md-6 col-xs-12">
                <label>Purchase Location</label>
                {{ Form::text('expense_location',  $entry->expense_location, ['class' => 'form-control']) }}
            </div>                  

            <div class="col-md-6 col-xs-12">
                <label>Expense Category</label>
                {{ Form::select('expense_category_id',
                            array('Select Expense Category' => 'Select Expense Category','Available Categories' => $available_categories),
                            $entry->expense_category_id,
                            ['class'=>'form-control'])  
                }}
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Purchase Date / Time</label>
                      <div class='input-group date' id='expense_datetime'>
                          <input type='text' name="expense_datetime" class="form-control" readonly="" value="{{ $entry->expense_datetime }}"/>
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
                {{ Form::text('expense_company_bn', $entry->expense_company_bn, ['class' => 'form-control']) }}
            </div>       
            <div class="col-md-6 col-xs-12">
                <label>Expense Subtotal (56.99)</label>
                {{ Form::number('expense_amount', $entry->expense_amount, ['class' => 'form-control','step' => '000.01']) }}
            </div>                      
            <div class="col-md-6 col-xs-12">
                <label>Expense Tax Amount (10.25)</label>
                {{ Form::number('expense_tax', $entry->expense_tax, ['class' => 'form-control', 'step' => '000.01']) }}
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
                            $entry->expense_payment_type,
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
        @if( ! count($attachments) > 0)
            <p>No expense attachments exist for this entry. You should probably add one.</p>
        @else            
            <div class="col-md-12 col-xs-12">
                @foreach($attachments as $attachment)
                <div class="col-xs-4">
                    <a href="{{ URL::to($attachment->expense_attachment_file) }}">
                        <img src="{{ URL::to($attachment->expense_attachment_file) }}" class="img-responsive"/>
                    </a>   
                </div>              
                @endforeach
            </div>
        @endif

            <div class="col-md-12 col-xs-12">
                <label>Add Receipt Picture</label>
                {{ Form::file('expense_attachment', ['class' => 'form-control', 'accept'=>'image/*', 'capture'=>'camera']) }}
            </div>                                  
        </div>
    </div>
</section>

<section class="content">
    <div class="row-fluid">
        <div class="col-md-6 col-xs-12">
            <label>Expense Comments</label>
            {{ Form::textarea('expense_comments', $entry->expense_comments,['class' => 'form-control', 'placeholder' => 'Expense Comments', 'rows'=>4]) }}
        </div>
    </div>        
</section>

<section class="content">
    <div class="row-fluid">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">Available Actions</div>
                <div class="panel-body">
                    <div class="col-md-2 col-xs-6">
                        <input type="submit" class="btn btn-flat btn-success" value="Update Expense Entry">
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <a href="" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger">Delete Entry</a>
                    </div>                    
                    @if($entry->deleted_at !== NULL)
                    <div class="col-md-2 col-xs-6">
                        <a href="" data-toggle="modal" data-target="#confirm-restore" class="btn btn-success">Restore</a>
                    </div>                        
                    @endif
                </div>
            </div>            
        </div>
    </div>
</section>
    

{{ Form::close() }}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Operation
            </div>
            <div class="modal-body">
                @if($entry->deleted_at !== NULL)
                    This expense entry has already been deleted. You can forcefully remove this entry by clicking delete below. Proceed?
                @else
                 You are attempting to delete this expense entry. Are you sure you wish to proceed? 
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Deletion</button>
                @if($entry->deleted_at !== NULL)
                    <a href="{{ URL::to('expensestracker/forcedeleteentry') . '/' . $entry->id }}" class="btn btn-danger danger">Delete Entry</a>
                @else
                    <a href="{{ URL::to('expensestracker/deleteentry') . '/' . $entry->id }}" class="btn btn-danger danger">Delete Entry</a>
                @endif                
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-restore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Operation
            </div>
            <div class="modal-body">
                <p>This expense entry has been deleted. You can restore this entry by pressing restore below. Proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Restoration</button>
                <a href="{{ URL::to('expensestracker/restoreentry') . '/' . $entry->id }}" class="btn btn-success success">Restore Entry</a>
            </div>
        </div>
    </div>
</div>    
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
});
$('#confirm-restore').on('show.bs.modal', function(e) {
    $(this).find('.restore').attr('href', $(e.relatedTarget).data('href'));
});
</script>
@stop