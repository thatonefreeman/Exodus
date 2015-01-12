@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Mileage Tracker
        <small>Viewing Entry</small>
    </h1>
</section>
<hr>

    {{ Form::open(array('route' => 'mt.updateentry')) }}

    <section class="content">
        <div class="col-md-6">
            <div class="row-fluid">
                <legend><h3>Odometer Readings</h3></legend>

                <div class="col-md-6 col-xs-12">
                    <label>Odometer Start</label>
                    {{ Form::number('odometer_start', $entry->odometer_start, ['class' => 'form-control']) }}
                </div>

                <div class="col-md-6 col-xs-12">
                    <label>Odometer Finish</label>
                    {{ Form::number('odometer_finish',$entry->odometer_finish, ['class' => 'form-control']) }}
                </div>            

                <div class="col-md-6 col-xs-12">
                    <label>Distance Travelled (KM)</h3></label>
                    {{ Form::text('distance_travelled', $entry->odometer_finish - $entry->odometer_start, ['class' => 'form-control', 'readonly'=>'']) }}
                </div>        

                <div class="col-md-6 col-xs-12">
                    <label>Created At</label>
                    {{ Form::text('created_at', $entry->created_at, ['class' => 'form-control', 'readonly'=>'']) }}
                </div>
                
                <div class="col-md-6 col-xs-12">
                    <label>Vehicle</label>
                    {{ Form::text('vehicle_id', $entry->license, ['class' => 'form-control', 'readonly'=>'']) }}
                </div>                  
                
            </div>    
            
            <div class="row"></div>
            
            <div class="row-fluid">
                <legend><h3>Log/Travel Reason</h3></legend>
                <div class="col-md-12 col-xs-12">
                    <label>Travel Reason (If other, specify in comments field)</label>
                    {{ Form::select('travel_reason', ['Start of Day'=>'Start of Day','End of Day'=>'End of Day','Service Call'=>'Service Call', 'Filling Up Car'=>'Filling Up Car', 'Purchasing Business Materials'=>'Purchasing Business Materials', 'Personal Use'=>'Personal Use','Other'=>'Other'], $entry->travel_reason, ['class'=>'form-control'])  }}
                </div>

                <div class="col-md-6 col-xs-12">
                    <label>Origin Address</label>
                    {{ Form::text('travel_origin', $entry->travel_origin, ['class' => 'form-control', 'placeholder' => 'Origin Address']) }}
                </div>        

                <div class="col-md-6 col-xs-12">
                    <label>Destination Address</label>
                    {{ Form::text('travel_destination', $entry->travel_destination, ['class' => 'form-control', 'placeholder' => 'Destination Address']) }}
                </div>        
            </div>  
            
            <div class="row-fluid">
                <div class="col-xs-12">
                    <label>Comments</label>
                    {{ Form::textarea('travel_comments', $entry->travel_comments,['class' => 'form-control', 'placeholder' => 'Travel Comments', 'rows'=>4]) }}
                </div>
            </div>             
            
        </div>
        <div class="col-md-6">
            <div class="row-fluid">
                <legend><h3>Fuel Consumption</h3></legend>
                <div class="col-md-6 col-xs-12">
                    <label>Are you filling your vehicle?</label>
                    {{ Form::select('filling_up', [
                                'Yes' => 'Yes',
                                'No' => 'No'],
                                $entry->filling_up,
                                ['class'=>'form-control'])  
                    }}
                </div>        
                <div class="col-md-6 col-xs-12">
                    <label>Current Tank Level</label>
                    {{ Form::select('fuel_level', ['0' =>'Select Level','10' => '10', '9' =>'9','8'=>'8', '7'=>'7', '6'=>'6', '5'=>'5','4'=>'4','3'=>'3','2'=>'2','1'=>'1','Empty'=>'Empty'], $entry->fuel_level, ['class'=>'form-control'])  }}
                </div>        
                <div class="col-md-6 col-xs-12">
                    <label>Price per Litre (Example: 88.4)</label>
                    {{ Form::number('price_per_litre',$entry->price_per_litre, ['class' => 'form-control', 'step' => '000.01']) }}
                </div>
                <div class="col-md-6 col-xs-12">
                    <label>Number of Litres Purchased</label>
                    {{ Form::number('litres_purchased',$entry->litres_purchased, ['class' => 'form-control', 'step' => '000.01']) }}
                </div>       
                <div class="col-md-6 col-xs-12">
                    <label>Total Fuel Cost($)</label>
                    {{ Form::number('total_fuel_cost',$entry->total_fuel_cost, ['class' => 'form-control', 'step' => '000.01']) }}
                </div>            
            </div>    
            
            <div class="row"></div>
            <div class="row-fluid">
                <legend><h3>Fuel Attachments</h3></legend>
                <div class="col-md-3 col-xs-3">
                    <a href="{{ URL::to($entry->mileage_attachement) }}">
                        <img src="{{ URL::to($entry->mileage_attachement) }}" class="img-responsive"/>
                    </a>
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
                            <input type="submit" class="btn btn-flat btn-success" value="Update Log">
                        </div>
                        <div class="col-md-2 col-xs-6">
                            <a href="#" class="btn btn-flat btn-danger">Delete Entry</a>
                        </div>                    
                    </div>
                </div>            
            </div>
        </div>
    </section>
    
    {{ Form::close() }}


@stop