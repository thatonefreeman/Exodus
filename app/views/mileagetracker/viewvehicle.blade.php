@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
        <small>Viewing Vehicle</small>
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
    <div class="row-fluid">
        <div class="col-md-6 col-xs-6">
            <legend><h3>Vehicle Details</h3></legend>

            <div class="col-md-6 col-xs-12">
                <label>License Plate</label>
                {{ Form::text('vehicle_license_plate', $entry->vehicle_license_plate, ['class' => 'form-control']) }}
            </div>        
            
            <div class="col-md-6 col-xs-12">
                <label>Registered Driver</label>
                {{ Form::text('vehicle_owner', $entry->vehicle_owner, ['class' => 'form-control']) }}
            </div> 
            
            <div class="col-md-6 col-xs-12">
                <label>Vehicle Make/Model</label>
                {{ Form::text('vehicle_make_model', $entry->vehicle_make_model, ['class' => 'form-control']) }}
            </div> 
            <div class="col-md-6 col-xs-12">
                <label>Vehicle Year</label>
                {{ Form::text('vehicle_year', $entry->vehicle_year, ['class' => 'form-control']) }}
            </div>  
            
            <div class="col-md-6 col-xs-12">
                <label>Vehicle Attachment</label>
                {{ Form::text('', '', ['class' => 'form-control']) }}
            </div>              
            
        </div>
        
        <div class="col-md-6 col-xs-6">
            <legend><h3>Vehicle Statistics</h3></legend>

            <div class="col-md-12 col-xs-12">
                <label>Number of Fill Ups</label>
                <b>make this method return more than just fill ups, return an array of stats</b>
                {{ Form::text('', $stats, ['class' => 'form-control', 'readonly' => '']) }}
            </div>                     
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
                        <input type="submit" class="btn btn-flat btn-success" value="Update Vehicle">
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <a href="#" class="btn btn-flat btn-danger">Delete Vehicle</a>
                    </div>                    
                </div>
            </div>            
        </div>
    </div>
</section>
@stop