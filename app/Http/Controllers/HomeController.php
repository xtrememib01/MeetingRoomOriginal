<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookRoom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function events(){
        $brs= BookRoom::all();
        $event_array = [];
        foreach($brs as $br){
            if($br->status=='Accepted' || auth()->user()->user_type=='God'){
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
}
