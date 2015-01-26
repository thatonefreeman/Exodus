@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>Overview</small>
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

<section class="content">
    <legend>Current Records</legend>          

    <section class="content">
        <div class="col-xs-6">
            {{ $entries->links(); }}
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon bg-aqua">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </span>                     
                    {{ Form::open(array('url' => 'expensetracker')) }}
                        {{ Form::select('filter_by_category',
                                    array('Filter By Category' => 'Filter By Category','Available Categories' => $expense_categories),
                                    'Select Expense Category',
                                    ['class'=>'form-control'])  
                        }}                   
                    {{ Form::close() }}
                </div>                    
            </div>
        </div>
        <div class="col-xs-3">
            {{ Form::open(array('url' => '/expensestracker')) }}
                
                @if(Session::get('show_deleted') == 'yes')
                    {{ Form::hidden('show_deleted', 0) }}
                    <button name="show_deleted_form" value="submitted" type="submit" class="btn bg-green"><span class="glyphicon glyphicon-trash"></span> Hide Trashed</button>
                @else
                    {{ Form::hidden('show_deleted', 1) }}
                    <button name="show_deleted_form" value="submitted" type="submit" class="btn bg-aqua"><span class="glyphicon glyphicon-trash"></span> Show Trashed</button>
                @endif
                
            {{ Form::close(); }}
        </div>          
    </section>
    
    <div class="row-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                <td><strong>Entry ID</strong></td>
                <td><strong>Expense Type</strong></td>
                <td><strong>Expense Timestamp</strong></td>
                <td><strong>Expense Company</strong></td>
                <td><strong>Created At</strong></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $entry)
                @if($entry->deleted_at !== NULL)
                <tr class="bg-red">
                @else
                <tr>
                @endif
                
                    <td>{{link_to_route('ex.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                    <td>{{ $entry->expense_category }}</td>
                    <td>{{ $entry->expense_datetime }}</td>
                    <td>{{ $entry->expense_company_name }}</td>
                    <td>{{ $entry->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
    
    {{ $entries->links(); }}
    
</section>
@stop