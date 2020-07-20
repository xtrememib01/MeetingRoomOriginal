<?php

namespace App\Http\Controllers;

use App\BookRoom;
use Illuminate\Http\Request;
use App\Locations;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class BookRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (\Auth::check()) {//checks if the user is authenticated
            //this creates an instance of Bookroom with the entire dataset
            $br= BookRoom::all();
            //this creates an array where we intent to store the desired bookroom instance matching the ACCEPT/ AUTH->USER / SUPER data
            $desiredbookroom = array();
            
        foreach($br as $bookroom){
            // {{-- Show the bookings that are 
            //     1. accepted and
            //     2.  the ones created by the user itself 
            //     3. The ones for which a user is super user--}}
            //     {{-- {{$bookroom->user_id}}{{auth()->user()->id}}{{auth()->user()->status}}{{auth()->user()->location}}{{$bookroom->user->location}                        {{$bookroom->user_id}} --}}
                if($bookroom->status =='Accept' ||  
                    auth()->user()->user_type == 'God' ||   
                    $bookroom->user_id == auth()->user()->id || 
                    ($bookroom->user->location == auth()->user()->location && auth()->user()->user_type =='Super')
                    ){
                        //the dataset that matches the set is entered into the array and passed on to the index view.
                        $desiredbookroom[] = $bookroom;
                    }
            }        
            return view('bookroom.index')->with('bookrooms',$desiredbookroom);

        }
        else return redirect()->route('login');
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $locations= Locations::all();
            return view('bookroom.create')->with('locations',$locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request,[
            'conference_details'    =>'required',
            'date'                  => 'required',
            'startTime'             => 'required',
            'endTime'               => 'required',
            'locations'             => 'required',
            'agenda'                => 'required'
            // 'textArea'              => 'required'
        ]);
        
        //Create an Instance of BookRoom Model
        $br = BookRoom::all();
        //Location requested by the user; locations is an array of string
        $locationsArray=$request->locations;
        
        $rDt=$request->date;
        $rSt= $request->startTime;
        $rEt= $request->endTime;

        $check = $this->checkduplicateentry ($locationsArray, $br, $rDt, $rSt, $rEt);
        print $check;
           
                if ($check ==true) {
                    return redirect ('\bookroom')->with('error','Duplicate entry can not be created. Check location with date and time');
                }
                else {
                    return $this->createRequest($request);
                    }

       
    }

 function createRequest(Request $request){
    $brr= New BookRoom();
    $brr->conference_details = $request->conference_details;
    $brr->date = $request->date;
    $brr->startTime = $request->startTime;
    $brr->endTime = $request->endTime;
    $brr->shifts = $request->locations;
    $brr->agenda = $request->agenda;
    $brr->user_id = auth()->user()->id; 
    
    if(auth()->user()->user_type == 'God'){
        $brr->status = 'Accept';    
    }
    else{$brr->status = 'pending';}
    
    $brr->textArea = $request->textArea; 
    $brr->save();
    return redirect ('\bookroom')->with('success','Entry created');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\BookRoom  $bookRoom
     * @return \Illuminate\Http\Response
     */
    public function show(BookRoom $bookroom)
    {
              return view('bookroom.show')->with('bookroom',$bookroom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookRoom  $bookRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRoom $bookroom)
    {

             // print $bookroom->status ."Room booked by user". $bookroom->user->name. ' logged in user ' .  auth()->user()->name .
            // 'user location who booked the room '. $bookroom->user->location . 'location of the logged in user'. auth()->user()->location. ' logged in user type
            // '. auth()->user()->user_type;


    //  only the super user of the location and the pending request can be edited by the logged in user
        // if(($bookroom->status== 'Pending' && ($bookroom->user_id == auth()->user()->id)) ||
        if( auth()->user()->user_type =='God' ||
            ($bookroom->user_id == auth()->user()->id) ||
                ($bookroom->user->location == auth()->user()->location && auth()->user()->user_type =='Super')){
            return view('bookroom.edit')
                                    ->with('bookrooms',$bookroom)
                                    ->with('locations',Locations::all());
        }
        else {
            return redirect ('\bookroom')->with('error','Attempting to access unauthorised data');
            }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookRoom  $bookRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookRoom $bookroom)
    {
    
        $this->validate($request,[
            'conference_details'    =>'required',
            'date'                  => 'required',
            'startTime'             => 'required',
            'endTime'               => 'required',
            'locations'             => 'required',
            'agenda'                => 'required'
        ]);
        
        $br = $bookroom;
        $br->conference_details = $request->conference_details;
        $br->date= $request->date;
        $br->startTime = $request->startTime;
        $br->endTime = $request->endTime;
        $br->shifts = $request->locations;
        $br->agenda = $request->agenda;
        if($request->status != null){
            $br->status=$request->status;
        }
        $br->save();

        return view ('bookroom.index')
                                        ->with('success','Entry created')
                                        ->with('bookrooms',BookRoom::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookRoom  $bookRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRoom $bookroom)
    {
        $bookroom->delete();
        return redirect('\bookroom');
    }

    public function insertANewLine(){
        echo nl2br("\n");
        
    }

    function events(){
        $brs= BookRoom::all();
        $event_array = [];
        foreach($brs as $br){
            if($br->status=='Accept' || auth()->user()->user_type=='God'){
            $event_object = [
                'start' =>$br->date,
                'title' =>$br->conference_details,
                // 'title' =>'<?php echo <span style="color:red"> )'.$br->agenda.' </span>,
                // 'title' =>$br->agenda.'   ('.$br->startTime.' to '.$br->endTime.')',
                'url'   => '/bookroom/'.$br->id
            ];
            array_push($event_array,$event_object);
        }
        }
        return $event_array;
    }

    public function lapupd(){
        return view('sreenath-lapupd');
    }


    public function checkduplicateentry ( $locationsArray,  $BookRoom, $rDt, $rSt, $rEt){
        foreach ($locationsArray as $location) {
            // checks the date for individual locations.
            $queryBuild = Bookroom::where('shifts','like','%'.$location.'%')
                                ->where('date',$rDt)
                                // ->orWhere(function($query) use($rSt,$rEt){
                                //     $query->where('startTime','>', $rEt)
                                //           ->Where('endTime','<',$rSt);})
                                ->where('startTime','>', $rEt)
                                ->Where('endTime','<',$rSt)
                                ->count();

                if ($queryBuild>0){
                    print $queryBuild;
                       return true;
                    }
            }          
                print $queryBuild;
                 return false;
        }

        public function smsOngc(BookRoom $bookroom){
            
            
            $contact =array();
            // $userPhone = $bookroom->user;
            // return $userPhone->Phone;
            $i= 0;
            foreach($bookroom->shifts as $location){
                //find all the first normal user and store them in an array ; Required to send each of them a text message
                
                try {
                    if (\App\User::all()->where('location',$location)->where('user_type','Normal')->first()->Phone!= null){
                        $contact[] = \App\User::all()->where('location',$location)->where('user_type','Normal')->first()->Phone;
                    }     
                }
                catch (\Exception $e) {
                    
                }
            }
            
            // return $contact;
            $contractString = null;
            for($i=0;$i<count($contact);$i++){
                if ($i==0){ $contractString = $contact[$i];}
                else{$contractString = $contractString.'+'.$contact[$i];}
            }
           
            $client = new \GuzzleHttp\Client();
            // $client->request('GET', '/', ['proxy' => '8.8.8.8']);
            $url ='http://10.205.48.187:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to='.
                $contractString.'&text=VC+Scheduled+on+'.
                $bookroom->date.'+from+'.$bookroom->startTime.'+hrs+onwards+on+the+agenda+'.$bookroom->conference_details.'&remLen=148&charset=UTF-8';
            //return $url;
            $res = $client->request('GET', $url);
            return redirect ('\bookroom')->with('success','message sent to all the participants');
        }
}

