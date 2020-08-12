@inject('Locations', 'App\Locations')
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

        <br>
        <label for="Select Location">Select Location</label>
        <br>
        <div class="overflow-auto form-group" style="height:20em">    
            {{-- <select multiple class="form-control" style="min-height:200px"name="locations[]" id="exampleFormControlSelect1"> --}}
                {{-- to present the entire locations form the locations table--}}
                
                @foreach ($locations as $location)    
                {{-- diffeent ids are required otherwise they cant bechecked together --}}
                <input id ="{{$location->location}}" type="checkbox" name ="locations[]" value="{{$location->location}}" 
                    @if (in_array($location->location,$locationAray))checked
                            @endif>     
                <label for="{{$location->location}}" >{{$location->location}}</label><br>
                
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            <textarea class="form-control" id="agenda" name="agenda"  rows="5"> {{$bookrooms->agenda}}</textarea>
            {{-- <input type="textArea" class="form-control" id="agenda" name="agenda" value= {{$bookrooms->agenda}}> --}}
        </div>

        <br>
        <label for="platform">Platform</label>
        <div>
            <select id="platform" type="text" class="form-control @error('platform') is-invalid @enderror" name="platform" value="{{ old('platform') }}" autofocus>
                <option value="none">None</option>
                <option value="Corporate VC"
                    @if($bookrooms->platform == "Corporate VC")selected
                    @endif>
                    Corporate VC
                </option>

                <option value="Lifesize" 
                    @if($bookrooms->platform == "Lifesize")selected
                    @endif>Lifesize
                </option>
                
                <option value="MSTeams"
                    @if($bookrooms->platform == "MSTeams")selected
                    @endif>MSTeams
                </option>

                <option value="Webex"
                    @if($bookrooms->platform == "Webex")selected
                    @endif>Webex
                </option>
            </select>
            @error('user_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br/>
        <br/>   

        <div class="form-group">
            <label for="url">Meeting Link</label>
            {{-- <input type="textArea" class="form-control" id="agenda" name="agenda" rows="5"> --}}
        <textarea class="form-control" id="url" name="url"  rows="5">{{$bookrooms->url}}</textarea>
        </div>

        @if (auth()->user()->user_type =="Super" || auth()->user()->user_type =='God')
        <div class="form-group">
            <label for="status">Agenda</label>
            <select id ="status"  type="text" class="form-control" id="status" name="status" value= {{$bookrooms->status}}>
                <option value="Pending" class="success">Pending</option>
                <option value="Accepted" class="success">Accept</option>
                <option value="Reject" class="danger" selected >Reject</option>
            </select>
        </div>
        @endif
       
        <button type="submit" class="btn btn-success">Submit</button>
        </form>
        @endauth
</div>
    
@endsection
