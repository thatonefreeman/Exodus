@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        System
        <small>Database Overview</small>
    </h1>
</section>
<hr>

<section class="content">
    <div class="row-fluid">
        <div class="col-md-6 col-xs-6">
            <legend><h3>Cron Job Backups</h3></legend>
            
            <div class="col-md-12 col-xs-12">
                <p>The following files have been automatically created via the 
                cronjob system. Backups are performed nightly at 6:00PM.</p>                
                <hr>
                <table class="table table-hover table-striped table-bordered table-condensed">
                @if(count($backups) == 0)
                    {{  'No backups are available at this time.' }}
                @else
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup }}</td>
                            <td><a href="{{ URL::to('backups/' . $backup)}} " class="btn btn-flat btn-sucess">Download Backup</a></td>
                        </tr>

                    @endforeach
                    </table>                
                @endif

                
                
            </div>                  
            
        </div>

    </div>
</section>

@stop