@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
        <small>Fleet Overview</small>
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
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
            <td><strong>Vehicle ID</strong></td>
            <td><strong>Owner / Driver</strong></td>
            <td><strong>Make/Model/Year</strong></td>
            <td><strong>Created At</strong></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($entries as $entry)
            <tr>
                <td>{{link_to_route('mt.viewvehicle', $title=$entry->vehicle_license_plate, $parameters = array($entry->id), $attributes = array());}}</td>
                <td>{{ $entry->vehicle_owner }}</td>
                <td>{{ $entry->vehicle_make_model }} / {{ $entry->vehicle_year }}</td>
                <td>{{ $entry->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop