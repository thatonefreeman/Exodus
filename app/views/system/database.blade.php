@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        System
        <small>Database Overview</small>
    </h1>
    <hr>
</section>

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
    <div class="col-xs-12">
        <legend>Cron Job Backups</legend>
        <p>The following files have been automatically created via the 
        cronjob system. Backups are performed nightly at 6:00PM.</p>                       
    </div>    
</section>

<section class="content">
    <div class="col-md-6 col-xs-6">
        <legend>Available Backups</legend>

        @if(count($backups) == 0)
            {{  '<p>No backups are available at this time.</p>' }}
        @else
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <td><strong>Delete</strong></td>
                        <td><strong>Download</strong></td>
                        <td><strong>File Name</strong></td>
                    </tr>
                </thead>
            @foreach($backups as $backup)
            <tr class="backup-row">
                <td>{{ HTML::decode(HTML::linkRoute('system.database.delete', '<i class="glyphicon glyphicon-trash"></i>', $backup, ['class' => 'js-delete btn btn-danger', 'title' => 'Delete Backup', 'data-model' => 'this database backup'])) }}</td>
                <td><a href="{{ URL::to('backups/' . $backup)}} " class="btn btn-success"><i class="glyphicon glyphicon-cloud-download"></a></td>          
                <td>{{ $backup }}</td>
            </tr>

            @endforeach
            </table>                
        @endif
    </div>           

    <div class="col-md-6">
        <legend>Perform Backup</legend>
        {{ HTML::decode(HTML::linkRoute('system.database.backup', '<i class="glyphicon glyphicon-cloud"></i> Backup Now', null, ['class' => 'btn btn-success', 'title' => 'Backup Now'])) }}          
    </div>
</section>
@stop