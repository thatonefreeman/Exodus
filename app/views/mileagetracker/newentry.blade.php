@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
        <small>New Entry</small>
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



    {{ Form::open(array('route' => 'mt.donewentry', 'files'=>true)) }}

    <div class="col-md-6">
        <section class="content">
            <div class="row-fluid">
                <legend><h3>Odometer Readings</h3></legend>

                <div class="col-md-6 col-xs-12">
                    <label>Odometer Start</label>
                    {{ Form::number('odometer_start','', ['class' => 'form-control', 'id' => 'start']) }}
                </div>

                <div class="col-md-6 col-xs-12">
                    <label>Odometer Finish</label>
                    {{ Form::number('odometer_finish','', ['class' => 'form-control', 'id' => 'finish']) }}
                </div>            

                <div class="col-md-6 col-xs-12">
                    <label>Distance Travelled (KM)</h3></label>
                    {{ Form::number('distancetravelled', '', ['class' => 'form-control', 'readonly' => '', 'id' => 'distance']) }}
                </div>        

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Log Time</label>
                          <div class='input-group date' id='log_datetime'>
                              <input type='text' name="log_datetime" class="form-control" readonly=""/>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>                 
                    </div>                    
                </div>      
                
                <div class="col-md-6 col-xs-12">
                    <label>Vehicle</label>
                    {{ Form::select('vehicle_id',
                                array('Select Vehicle' => 'Select Vehicle','Current Fleet' => $available_vehicles),
                                'Select Vehicle',
                                ['class'=>'form-control'])  
                    }}
                </div>                        
            </div>        
        </section>        
    </div>
    
    <div class="col-md-6">
        <section class="content">
            <div class="row-fluid">
                <legend><h3>Fuel Consumption</h3></legend>
                <div class="col-md-6 col-xs-12">
                    <label>Are you filling your vehicle?</label>
                    {{ Form::select('filling_up', [
                                'Yes' => 'Yes',
                                'No' => 'No'],
                                'No',
                                ['class'=>'form-control'])  
                    }}
                </div>        
                <div class="col-md-6 col-xs-12">
                    <label>Current Tank Level</label>
                    {{ Form::select('fuel_level', ['0' =>'Select Level','10' => '10', '9' =>'9','8'=>'8', '7'=>'7', '6'=>'6', '5'=>'5','4'=>'4','3'=>'3','2'=>'2','1'=>'1','Empty'=>'Empty'], null, ['class'=>'form-control'])  }}
                </div>        
                <div class="col-md-6 col-xs-12">
                    <label>Price per Litre (Example: 88.4)</label>
                    {{ Form::number('price_per_litre','', ['class' => 'form-control', 'step' => '000.01']) }}
                </div>
                <div class="col-md-6 col-xs-12">
                    <label>Number of Litres Purchased</label>
                    {{ Form::number('litres_purchased','', ['class' => 'form-control', 'step' => '000.01']) }}
                </div>       
                <div class="col-md-6 col-xs-12">
                    <label>Total Fuel Cost($)</label>
                    {{ Form::number('total_fuel_cost','', ['class' => 'form-control', 'step' => '000.01']) }}
                </div>            
            </div>        
             
        </section>        
    </div>
    
    <section class="content">
        <div class="row-fluid">
            <div class="col-md-12">
                <label>Take New Image</label>
                {{ Form::file('mileage_attachment', ['class' => 'form-control', 'accept'=>'image/*']) }}
            </div>  
        </div>
    </section>
    
    <section class="content">
        <div class="row-fluid">
            <legend><h3>Log/Travel Reason</h3></legend>
            <div class="col-md-4 col-xs-12">
                <label>Travel Reason (If other, specify in comments field)</label>
                {{ Form::select('travel_reason', ['Start of Day'=>'Start of Day','End of Day'=>'End of Day','Service Call'=>'Service Call', 'Filling Up Car'=>'Filling Up Car', 'Purchasing Business Materials'=>'Purchasing Business Materials', 'Personal Use'=>'Personal Use','Other'=>'Other'], 0, ['class'=>'form-control'])  }}
            </div>

            <div class="col-md-4 col-xs-12">
                <label>Origin Address</label>
                {{ Form::text('travel_origin', '', ['class' => 'form-control', 'placeholder' => 'Origin Address']) }}
            </div>        
            
            <div class="col-md-4 col-xs-12">
                <label>Destination Address</label>
                {{ Form::text('travel_destination', '', ['class' => 'form-control', 'placeholder' => 'Destination Address']) }}
            </div>        
        </div>          
    </section>
    
    <section class="content">
        <div class="row-fluid">
            <div class="col-xs-12">
                <label>Comments</label>
                {{ Form::textarea('travel_comments', '',['class' => 'form-control', 'placeholder' => 'Travel Comments', 'rows'=>4]) }}
            </div>
        </div>        
    </section>
    
    <section class="content">
        <div class="row-fluid">
            <div class="panel panel-info">
                <div class="panel-heading">Available Actions</div>
                <div class="panel-body">
                    <div class="col-md-2 col-xs-6">
                        <input type="submit" class="btn btn-flat btn-success" value="Review & Submit Log">
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <a href="#" class="btn btn-flat btn-danger">Cancel Entry</a>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    
    {{ Form::close() }}
    

    
@stop