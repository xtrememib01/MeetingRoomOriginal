@extends('layouts.app')
@section('content')
    @include('inc.messages')
    <div class="container">
        <div class="page-header text-center mt-4">
            {{-- <h1>Calendar view</h1> --}}
        </div>
        <div class="container">
            <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body text-center">
                <h2 class="card-title text-success">Time Left for the meeting</h2>
                <h4>
                    <p class="card-text">
                    <div id="timeLeft" class="text-center text-info text-danger" style="bold size">
                        <div id="dateFromTheGroup" hidden = "true">{{$bookroom->date}}</div>
                        <div id="startTime"  hidden = "true">{{$bookroom->startTime}}</div>
                    </div>   
                    </p>
                </h4>
            </div>

            </div>
        </div>
           
        @if (auth()->user()->user_type !== Null)
            <div class="container">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body ">
                        <a href="/bookroom/create">
                            <div class="row">
                                <i class="fa fa-address-book fa-3x col-1 mr-0 pr-0"></i>
                                <h4 class="card-title col-11  mt-2 ml-0 pl-0 ">Book  a conference room</h4>
                            </div>
                            <p class="card-text ml-5">Click on the above icon to book a conference room</p>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        
        
        <div class="container mt-6 ml-0 mr-0 pl-0 pr-0">
            
        
            <h3 class="mt-4 text-center">Booked Rooms</h3>
            <div class="col-12" >
            <table class="table table-bordered table-hover " style="border:0">
                <thead class="thead-dark">
                        {{-- <th>Conference Details</th> --}}
                        <th style="width:35%" class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mt-2">Locations</th>
                        <th> Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th style="width:15%">Agenda</th>
                        <th>Features</th>
                        <th>Create by</th>
                        {{-- <th>Edit</th>
                        <th> Delete</th> --}}
                </thead>
        
                <tbody>
                        <tr>
                        {{-- <td>{{$bookroom->conference_details}}</td> --}}
                        <td>
                            @foreach ($bookroom->shifts as $location)
                                {{$location}}
                        <br>
                            @endforeach    
                        </td>
                        <td>{{$bookroom->date}}</td>
                        <td>{{$bookroom->startTime}}</td>
                        <td>{{$bookroom->endTime}}</td>
                        <td>{{$bookroom->agenda}}</td>
                        
                        <td>
                            <div class="d-inline-flex">
                                @if(($bookroom->user_id == auth()->user()->id && $bookroom->status !='Accepted') || 
                                    (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location)||
                                    auth()->user()->user_type=='God')
                        
                                    <button class="btn btn-success" style="border:none; margin-right:1em; width:5em; height:70%;">
                                        <a class="text-white" href= "/bookroom/{{$bookroom->id}}/edit" style="height:50%;">Edit</a>
                                    </button>
                                    
                                        <form action="/bookroom/{{$bookroom->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Sure to Delete')" class="btn btn-danger text-white" 
                                            style="border:none; margin-right:1em; width:5em; height:100%; " >Delete
                                            </button>
                                        </form>
                                @endif
                            
                                @if (auth()->user()->user_type =='God' ||
                                    $bookroom->user_id == auth()->user()->id && auth()->user()->user_type == 'Normal' && $bookroom->status == '
                                    ')
                                
                                    <form action="/sendSms/{{$bookroom->id}}" method="get">
                                            <button class="btn btn-primary text-white"
                                            style="border:none; margin-right:1em; width:5em; height:100%;">Invite
                                            </button>
                                    </form>
                                @endif     
                            </div>
                        </td>    
                        <td>{{$bookroom->user->name}}</td>   
                    </tr>                             
                </tbody> 
                <tr>
                </tr>  
            </table>
        
           
    
            </div>
            </div>
        </div>
    
   
    
@endsection