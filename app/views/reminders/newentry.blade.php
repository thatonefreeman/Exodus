@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Reminders
        <small>New Entry</small>
    </h1>
    <p>Adding a reminder will automatically send you reminders do complete a task at certain times.</p>
</section>
<hr>


    {{ Form::open(array('route' => 'reminders.donewentry')) }}


    
    
    
    {{ Form::close() }}


@stop