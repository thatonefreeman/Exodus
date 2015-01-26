@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
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
    <legend>Statistics</legend>
    <div class="col-md-4 col-xs-4">
        <label>Distances</label>
        <ul class="list-unstyled">
            <li>Total Distance(KM): {{$stats['odometer_finish_sum'] - $stats['odometer_start_sum']}}</li>
        </ul>
    </div>
    <div class="col-md-4 col-xs-4">
        <label>Fuel Consumption</label>
        <ul class="list-unstyled">
            <li>Total Fill-Ups: {{ $stats['fill_ups'] }}</li>
            <li>Total Litres Purchased: {{ $stats['total_litres_purchased'] }}</li>
            <li>Average Fuel Price: {{ $stats['average_fuel_price'] }}</li>
        </ul>
    </div>
</section>

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
                    {{ Form::open(array('url' => 'mileagetracker')) }}
                        {{ Form::select('mileage_category', 
                                    ['Select Travel Category',
                                     'Start of Day'=>'Start of Day',
                                     'End of Day'=>'End of Day',
                                     'Service Call'=>'Service Call', 
                                     'Filling Up Car'=>'Filling Up Car', 
                                     'Purchasing Business Materials'=>'Purchasing Business Materials', 
                                     'Personal Use'=>'Personal Use',
                                     'Other'=>'Other'], 
                                         0, 
                                         ['class'=>'form-control'])  }}     
                    {{ Form::close() }}
                </div>                    
            </div>
        </div>
        <div class="col-xs-3">
            {{ Form::open(array('url' => '/mileagetracker')) }}
                
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
    
    <section class="content">
        <div class="col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <td><strong>Entry ID</strong></td>
                    <td><strong>Travel Reason</strong></td>
                    <td><strong>Odometer Finish</strong></td>
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
                        <td>{{ link_to_route('mt.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                        <td>{{ $entry->travel_reason }}</td>
                        <td>{{ $entry->odometer_finish }}</td>
                        <td>{{ $entry->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </section>
</section>
@stop