@extends('layouts.master')

@section('content')
<section class="content">
    <div class="row-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">Available Actions</div>
            <div class="panel-body">
                <div class="col-md-2 col-xs-6">
                    <a href="{{ URL::to('reminders/newentry') }}" type="" class="btn btn-flat btn-success" >New Reminder</a>
                </div>    
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="col-md-3"><strong>Reminder ID</strong></div>
    <div class="col-md-3"><strong>Label</strong></div>
    <div class="col-md-3"><strong>Reminder Method</strong></div>
    <div class="col-md-3"><strong>Created At</strong></div>
</section>
<section class="content">
    @foreach ($reminders as $reminder)
    <div class="col-md-3">{{link_to_route('reminders.viewentry', $title=$entry->id, $parameters = array($entry->id), $attributes = array());}}</div>
    <div class="col-md-3">{{ $reminder->reminder_label }}</div>
    <div class="col-md-3">{{ $reminder->reminder_method }}</div>
    <div class="col-md-3">{{ $reminder->created_at }}</div>
    @endforeach
</section>
@stop