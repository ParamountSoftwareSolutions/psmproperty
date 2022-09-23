@extends('agents.app')
@section('body')

    <?php
    $propertyData = json_decode($property->data_array);
    ?>

    <div class="col-12">
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            <div class="intro-y col-span-6 sm:col-span-6">
                <h3 class="text-2xl">{{$propertyData->title}}</h3>
                <p><b>Area: </b> {{$propertyData->area}} {{$propertyData->area_type}}</p>
                <p><b>Location: </b> {{$propertyData->location}}</p>
                <p><b>For: </b> {{$propertyData->property_type}}</p>
            </div>
            <div class="intro-y col-span-6 sm:col-span-6 text-right">
                <a href="javascript:;" data-toggle="modal" data-target="#modal-edit-property" class="btn btn-sm text-color">Edit</a>
                <a href="javascript:;" data-toggle="modal" data-target="#update-property-status-modal" class="btn btn-sm text-color1">Update Status</a>
            </div>
        </div>
        <hr/>
    </div>
    <div class="col-12">
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
        <div class="intro-y col-span-6 sm:col-span-6">
            <h3 class="text-lg">Owner Information</h3>
            <p><b>Name: </b> {{$propertyData->owner_name}}</p>
            <p><b>Phone Number: </b> {{$propertyData->owner_phone}}</p>
        </div>
        <div class="intro-y col-span-6 sm:col-span-6">
            <h3 class="text-lg">Price Info</h3>
            <p><b>Ask Price: </b> {{$propertyData->ask_price}}</p>
            <p><b>Estimated Price: </b> {{$propertyData->estimated_price}}</p>
        </div>
        </div>

        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            <h3 class="text-lg">Logs</h3>
            @foreach($history as $historicalData)
                <div class="intro-y col-span-12 sm:col-span-12 history-comment">
                    <p> &#8226; {{$historicalData->history}}</p>
                    <p class="text-right"><small>{{$historicalData->created_at}}</small></p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
