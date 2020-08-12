@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart')

    <h4 class="secondary"><strong>Meeting Scheduled</strong></h4>
	<p>
		<strong>Locations required</strong>
		@foreach ($bookroom->shifts as $location) 
			<br>{{$location}}
		@endforeach                                
	</p>
	
	<p><strong> Date:</strong> {{$bookroom->date}}</p>
	<p><strong> From:</strong> {{$bookroom->startTime}}</p>
	<p><strong> Agenda:</strong> {{$bookroom->agenda}}</p>
	<p><strong> Click the link to join the meeting:</strong><a href="{{$bookroom->url}}">{{$bookroom->url}}</a></p>
	@include('beautymail::templates.widgets.articleEnd')

@stop