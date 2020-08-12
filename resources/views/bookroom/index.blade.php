@extends('layouts.app')
<script>
    function meetingEntry(no){
        document.getElementById('MeetingEntry'+no).style.display="block";
    }
</script>
@section('content')
    @include('inc.messages')
    <div class="container">
        <div class="page-header text-center mt-4">
            <h1>Calendar view</h1>
        </div>
        {{-- <div id="timer.js"></div> --}}
        
        {{-- Bookroom to be not avaialbe with the null/ webex/ lifesize / msteams user --}}
        @if (auth()->user()->user_type !== null && auth()->user()->user_type !== "Webex" && auth()->user()->user_type !== "MSTeams" && auth()->user()->user_type !== "Lifesize")
            <div class="container">
                <div class="card">
                    {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
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

        <div class="mt-4 ml-3 mr-3">
            <div id='calendar'></div>
        </div>
        <div id='timer.js'></div>

        {{-- The entire code below is for the purpose of summary of total rooms created --}}
    {{-- {{-- uncomment from line 34 to 88  --}}
  {{--  --}}
  @if (auth()->user()->user_type !== null)
    <div class="container mt-6 ml-0 mr-0 pl-0 pr-0">
        <h3 class="mt-4 ml-4 text-center">{{auth()->user()->name}}'s Dash Board</h3>
            <div class="col-12" >
            <table class="table table-bordered table-hover " style="border:0">
                <thead class="thead-dark">
                <tr>
                    {{-- <th class="col" style="width:10%">Conference Details</th> --}}
                    <th class="col" style="width:24%">Locations</th>
                    <th class="col" style="width:12%">Date</th>
                    <th class="col" style="width:4%">From</th>
                    {{-- To is taking lot of space and my not be relevant --}}
                    {{-- <th class="col" style="width:4%">To</th> --}}
                    <th class="col" style="width:28%">Agenda</th>
                    <th class="col" style="width:3%"> Status</th>
                    <th class="col" style="width:10%">Features</th>
                    <th class="col" style="width:10%">Created by</th>
                    {{-- <th class="col"> Delete</th>
                    <th class="col"> Send notification</th> --}}
                </tr>
                </thead>
                <tbody>

                    @foreach ($bookrooms as $bookroom)
                        {{-- @if(($bookroom->user_id == auth()->user()->id && $bookroom->status !='Accept') ||  --}}
                        {{-- locations that are also accepted to be show and not just accepted --}}
                        @if(($bookroom->user_id == auth()->user()->id) || 
                        (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location))
                            <tr>
                                <td>
                                    @foreach ($bookroom->shifts as $location) 
                                        {{$location}}<br><br>
                                    @endforeach
                                </td>
                                <td>{{$bookroom->date}}</td>
                                <td>{{$bookroom->startTime}}</td>
                                <td>{{$bookroom->agenda}}</td>
                                <td>{{$bookroom->status}}</td>

                {{-- make the field editable when the user
                    1. The logged in User is self
                    2. When the logged in User is super, and belongs to the location made by the user ofthe location (i.e. Delhi user can crate booking for ahmedabad and the same has to be approved vy the super used of Delhi and not Ahd
                   --}}             <td>
                                    <div class="d-inline-flex">{{--same user, super user and god user--}}
                                        @if(($bookroom->user_id == auth()->user()->id && $bookroom->status !=='Accepted') || 
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
                                            $bookroom->user_id == auth()->user()->id && auth()->user()->user_type == 'Normal' && $bookroom->status == 'Accepted')
                                        
                                            <form action="/sendSms/{{$bookroom->id}}" method="get">
                                                    <button class="btn btn-primary text-white"
                                                    style="border:none; margin-right:1em; width:5em; height:100%;">Invite
                                                    </button>
                                            </form>
                                        @endif     
                                    </div>
                                </td> 
                                <td>{{$bookroom->user->name}}
                                </td>                         
                            </tr>
                        @endif
                @endforeach
                
         
        
    </div>


{{-- Below is for WEBEX user,--}}

        @if(auth()->user()->user_type == "Webex")
            @foreach($bookrooms as $bookroom)
                @if($bookroom->platform == "Webex")
                <tr>
                    <td>@foreach ($bookroom->shifts as $location) {{$location}}<br><br>@endforeach</td>
                    <td>{{$bookroom->date}}</td>
                    <td>{{$bookroom->startTime}}</td>
                    <td>{{$bookroom->agenda}}</td>
                    <td>{{$bookroom->status}}</td>
                    <td></td>
                    <td>{{$bookroom->user->name}}
                        {{-- ONly when a Webex user enter the meeting room and the meeting is accepted --}}
                     @if(auth()->user()->user_type== "Webex" && $bookroom->status=="Accepted")
                     <button onclick="meetingEntry({{$bookroom->id}})" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
                     @endif

                        <br>
                        <div id="MeetingEntry{{$bookroom->id}}" style="display:none">
                            <form action="/MeetingEntry/{{$bookroom->id}}" method="GET">
                                @csrf
                                 <textarea name="url">{{$bookroom->url}}</textarea>
                                    <button type="submit" class="btn btn-primary btn-sm text-white">Submit the link</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endif
            @endforeach
        @endif     

        {{-- Below is for Lifesize user,--}}
        @if(auth()->user()->user_type == "Lifesize")
        @foreach($bookrooms as $bookroom)
            @if($bookroom->platform == "Lifesize")
            <tr>
                <td>@foreach ($bookroom->shifts as $location) {{$location}}<br><br>@endforeach</td>
                <td>{{$bookroom->date}}</td>
                <td>{{$bookroom->startTime}}</td>
                <td>{{$bookroom->agenda}}</td>
                <td>{{$bookroom->status}}</td>
                <td></td>
                <td>{{$bookroom->user->name}}
                    <br>
                    {{-- ONly when a Webex user enter the meeting room and the meeting is accepted --}}
                 @if(auth()->user()->user_type== "Lifesize" && $bookroom->status=="Accepted")
                 <button onclick="meetingEntry({{$bookroom->id}})" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
                 <br>
                 @endif
              {{--This is "MeetingEntry{{$bookroom->id is created for diff id no to each of the div which in turn is handled by the Javascript at the top}}"  --}}
                    <div id="MeetingEntry{{$bookroom->id}}" style="display:none">
                        <form action="/MeetingEntry/{{$bookroom->id}}" method="GET">
                            @csrf
                             <textarea name="url">{{$bookroom->url}}</textarea>
                                <button type="submit" class="btn btn-primary btn-sm text-white">Submit the link</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
    @endif     

    {{-- Below is for MSTeams user,--}}

    @if(auth()->user()->user_type == "MSTeams")
    @foreach($bookrooms as $bookroom)
        @if($bookroom->platform == "MSTeams")
        <tr>
            <td>@foreach ($bookroom->shifts as $location) {{$location}}<br><br>@endforeach</td>
            <td>{{$bookroom->date}}</td>
            <td>{{$bookroom->startTime}}</td>
            <td>{{$bookroom->agenda}}</td>
            <td>{{$bookroom->status}}</td>
            <td></td>
            <td>{{$bookroom->user->name}}
                {{-- ONly when a Webex user enter the meeting room and the meeting is accepted --}}
             @if(auth()->user()->user_type== "MSTeams" && $bookroom->status=="Accepted")
             <button onclick="meetingEntry({{$bookroom->id}})" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
             @endif
    
                <div id="MeetingEntry{{$bookroom->id}}" style="display:none">
                    <form action="/MeetingEntry/{{$bookroom->id}}" method="GET">
                        @csrf
                         <textarea name="url">{{$bookroom->url}}</textarea>
                            <button type="submit" class="btn btn-primary btn-sm text-white">Submit</button>
                    </form>
                </div>
            </td>
        </tr>
        @endif
    @endforeach
@endif     
    </tbody>
                
</table>
</div>
    @endif
    
@endsection