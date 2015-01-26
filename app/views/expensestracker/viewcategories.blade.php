@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Expenses Tracker
        <small>Category Overview</small>
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
    {{ Form::open(array('url' => 'expensestracker/donewcategory/')) }}
    <div class="col-md-6">
        
        <div class="row-fluid">
            
            <legend><h3>Add Category</h3></legend>

            <div class="col-md-12 col-xs-12 form-group">
                <label>Category Name</label>
                {{ Form::text('expense_category_name', null, ['class' => 'form-control']) }}
            </div>

            <div class="col-md-12 col-xs-12 form-group">
                <label>Description</label>
                {{ Form::textarea('expense_category_description', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>               
            
            <div class="col-xs-12 form-group">
                {{ Form::submit('Add Category', ['class' => 'btn btn-success']) }}
            </div>
            
        </div>    
    </div>
    {{ Form::close() }}
</section>

<section class="content">
    <legend>Current Categories</legend>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
            <td><strong>Entry ID</strong></td>
            <td><strong>Category Name</strong></td>
            <td><strong>Category Description</strong></td>
            <td><strong>Created At</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>{{ link_to_route('ex.viewcategory', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                <td>{{ $entry->expense_category_name }}</td>
                <td>{{ $entry->expense_category_description }}</td>
                <td>{{ $entry->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop