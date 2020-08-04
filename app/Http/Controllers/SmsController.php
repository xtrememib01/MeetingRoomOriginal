<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookRoom;
use App\Locations;
use App\User;
use Illuminate\Support\Collection;


class SmsController extends Controller
{
    public function smsOngc(BookRoom $bookroom){
        $contact =array();
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
