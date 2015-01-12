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
                <td>{{link_to_route('mt.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</td>
                <td>{{ $entry->travel_reason }}</td>
                <td>{{ $entry->odometer_finish }}</td>
                <td>{{ $entry->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@stop