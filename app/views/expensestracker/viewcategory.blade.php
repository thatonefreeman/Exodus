@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>Viewing Category</small>
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

{{ Form::open(array('url' => 'expensestracker/updatecategory/' . $entry->id)) }}
<section class="content">
    <div class="col-md-6">
        
        <div class="row-fluid">
            <legend>Category</legend>
            <div class="col-md-12 col-xs-12 form-group">
                <label>Category Name</label>
                {{ Form::text('expense_category_name', $entry->expense_category_name, ['class' => 'form-control']) }}
            </div>

            <div class="col-md-12 col-xs-12 form-group">
                <label>Description</label>
                {{ Form::textarea('expense_category_description', $entry->expense_category_description, ['class' => 'form-control', 'rows' => 4]) }}
            </div>               
            
        </div>    
    </div>
    
    <div class="col-md-6">
        
        <div class="row-fluid">
            <legend>Category Statistics</legend>
            
            <div class="col-md-4">
                <strong>Total Spent in Category </strong><p>$ {{ $stats['total_spent'] + $stats['total_tax'] }}</p>
            </div>
            <div class="col-md-4">
                <strong>Total Tax in Category </strong><p>$ {{ $stats['total_tax'] }}</p>
            </div>
            <div class="col-md-4">
                <strong>Number of Expenses </strong><p> {{ $stats['total_entries'] }}</p>
            </div>
            
        </div>
        
        <div class="row-fluid">
            <legend>Latest Expenses for Category</legend>
            
            @if(count($category_expenses) > 0)
            <div class="col-xs-12">
                <ul>
                    @foreach($category_expenses as $expense)
                    <li>{{ link_to_route('ex.viewentry', $title=$expense->expense_company_name, $parameters = array($expense->expense_id), $attributes = array());}} @ {{$expense->expense_datetime}}</li>
                    @endforeach
                </ul>
            </div>
            @else
            <p>No expenses to display for this category.</p>
            @endif
        </div>
    </div>
</section>

<section class="content">
    <div class="row-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">Available Actions</div>
            <div class="panel-body">
                <div class="col-md-2 col-xs-6">
                    <input type="submit" class="btn btn-flat btn-success" value="Update Category">
                </div>
                <div class="col-md-2 col-xs-6">
                    <a href="" data-toggle="modal" data-target="#confirm-delete" class="btn btn-flat btn-danger">Delete Entry</a>
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
                You are attempting to delete this expense category. Are you sure you wish to proceed?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Deletion</button>
                <a href="{{ URL::to('expensestracker/deletecategory') . '/' . $entry->id }}" class="btn btn-danger danger">Delete Category</a>
            </div>
        </div>
    </div>
</div>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
});
</script>
@stop