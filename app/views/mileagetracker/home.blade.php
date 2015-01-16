@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
        <small>Overview</small>
    </h1>
</section>
<hr>

<section class="content">
    @if(Session::has('message'))
    <div class="panel {{ Session::get('alert-class', 'panel-info')}}">
        <div class="panel-heading">Message</div>
        <div class="panel-body">
            <p>{{ Session::get('message') }}</p>
        </div>
    </div>    
    @endif       
    
    @if(count($errors) > 0)
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
    @endif
</section>

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
    <table class="table table-bordered table-hover table-striped">
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
            <tr>
                <td>{{ link_to_route('mt.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                <td>{{ $entry->travel_reason }}</td>
                <td>{{ $entry->odometer_finish }}</td>
                <td>{{ $entry->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop