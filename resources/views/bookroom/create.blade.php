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
            <input type="text" class="form-control" id="conference_details" name="conference_details" value={{old('conference_details')}}>
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" value={{old('date')}}>
            <input type="time" class="form-control col-4" id="startTime" name="startTime" value={{old('startTime')}}>
            <input type="time" class="form-control col-4" id="endTime" name="endTime" value={{old('endTime')}}>
        </div>

        <br>
        <label for="Select Location">Select Location</label>
        <br>
        <div class="overflow-auto form-group" style="height:20em">
            @foreach ($locations as $location)    
                <input id ="{{$location->location}}" type="checkbox" name ="locations[]" value="{{$location->location}}">
                <label for="{{$location->location}}" >{{$location->location}}</label><br>
            @endforeach

        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            {{-- <input type="textArea" class="form-control" id="agenda" name="agenda" rows="5"> --}}
        <textarea class="form-control" id="agenda" name="agenda" rows="5">{{old('agenda')}}</textarea>

        </div>

        <button type="submit" class="btn btn-success width:100%">Submit</button>
        </form>
        @endauth
        
</div>
    
@endsection
