@extends('layouts.app')
@section('content')
@include('inc.messages')
<div class="container">    
    @auth
    
        <div class="page-header text-center mt-4">
            <h1>Book conference room</h1>
        </div>
        <form action="/bookroom" method="post">
        @csrf
        <div class="form-group">
            <label for="conference_details">Conference details</label>
            <input type="text" class="form-control" id="conference_details" name="conference_details" >
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" >
            <input type="time" class="form-control col-4" id="startTime" name="startTime" >
            <input type="time" class="form-control col-4" id="endTime" name="endTime" >
            
        </div>
        <div class="form-group">
            <label for="Select Location">Select Location</label>
            <select multiple class="form-control" style="min-height:200px" name="locations[]" id="exampleFormControlSelect1">
                @foreach ($locations as $location)
                <option>{{$location->location}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            {{-- <input type="textArea" class="form-control" id="agenda" name="agenda" rows="5"> --}}
            <textarea class="form-control" id="agenda" name="agenda" rows="5"></textarea>

        </div>

        <!--Material textarea-->
        {{-- <div class="md-form mb-4 pink-textarea active-pink-textarea">
            <label for="agenda">Agenda</label>
            <textarea rows="10" id="agenda" name="agenda" class="md-textarea form-control"></textarea>
        </div> --}}

        <button type="submit" class="btn btn-success width:100%">Submit</button>
        </form>
        @endauth
        
</div>
    
@endsection
