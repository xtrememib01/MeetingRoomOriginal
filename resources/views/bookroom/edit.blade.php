@extends('layouts.app')
@section('content')
@include('inc.messages')
<div class="container">    
    @auth
    <form action="/bookroom/{{$bookrooms->id}}" method="POST">
        {{-- <form action="/bookroom/" method="POST"> --}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="conference_details">Conference details</label>
            <input type="text" class="form-control" id="conference_details" name="conference_details" value={{$bookrooms->conference_details}}>
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" value={{$bookrooms->date}}>
            <input type="time" class="form-control col-4" id="startTime" name="startTime" value={{$bookrooms->startTime}} >
            <input type="time" class="form-control col-4" id="endTime" name="endTime" value={{$bookrooms->endTime}}>
        </div>
        <div class="form-group">
            <label for="Select Location">Select Location</label>
            <select multiple class="form-control" style="min-height:200px"name="locations[]" id="exampleFormControlSelect1">
                @foreach ($locations as $location)
                    <option>{{$location->location}}</option>
                @endforeach         
            </select>
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            <input type="textArea" class="form-control" id="agenda" name="agenda" value= {{$bookrooms->agenda}}>
        </div>

        @if (auth()->user()->user_type =="Super")
        <div class="form-group">
            <label for="status">Agenda</label>
            <select id ="status"  type="text" class="form-control" id="status" name="status" value= {{$bookrooms->status}}>
                <option value="Pending" class="success">Pending</option>
                {{-- selected with if condition --}}
                <option value="Accept" class="success">Accept</option>
                <option value="Reject" class="danger" selected >Reject</option>
            </select>
        </div>
        @endif

        <button type="submit" class="btn btn-success">Submit</button>
        </form>
        @endauth
</div>
    
@endsection
