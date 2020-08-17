<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookRoom;
use App\Locations;
use App\User;
use Illuminate\Support\Collection;
use Adldap\Laravel\Facades\Adldap;


class SmsController extends Controller
{
    public function smsOngc(BookRoom $bookroom, Request $request){
        $contact =array();
        $contractString = null;
        $i= 0;
        foreach($bookroom->shifts as $location){
            $locationNormalUsers = \App\User::where('location', $location)->where('user_type','Normal')->get();
                foreach ($locationNormalUsers as $user){
                    if($contractString == null){$contractString = $user->Phone;}
                    else{$contractString = $contractString.'+'.$user->Phone;}
                }
        }
       
        $client = new \GuzzleHttp\Client();
        // $client->request('GET', '/', ['proxy' => '8.8.8.8']);
        $url ='http://10.205.48.187:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to='.
            $contractString.'&text=VC+Scheduled+on+'.
            $bookroom->date.'+from+'.$bookroom->startTime.'+hrs+onwards+on+the+agenda+'.$bookroom->conference_details.'&remLen=148&charset=UTF-8';
        //return $url;
        $res = $client->request('GET', $url);
        $this->sendEmail($bookroom,$request);
        return redirect ('\bookroom')->with('success','message sent to all the participants');
    }

    public function sendEmail(BookRoom $bookroom, Request $request){
       
        $emailArray =array();
        //create array from the comma separed textfield
        $additionalEmail = explode(',',$request->addEMail);
        foreach ($additionalEmail as $extraEmail){
            $emailArray[] =$extraEmail;
        }
        
        foreach($bookroom->shifts as $location){
            $locationUsers = \App\User::where('location', $location)->get();
                foreach ($locationUsers as $user){
                    $emailArray[] = $user->email;
                }
        }

        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
       
        /* this is a standard way of sending a mail to anyone
        $beautymail->send('emails.welcome', [], function($message)*/
        // To pass a varialbe the followingto be used:1st arguement: view; 2nd passed to the view, 3rd 
        $beautymail->send('emails.welcome', ["bookroom" => $bookroom], function($message) use(&$emailArray)
        {
            $message
                ->from('bookvc@ongc.co.in')
                // ->to(['PAREVA_DURGESH@ongc.co.in', 'xtrememib01@gmail.com'])
                ->to($emailArray)
                ->subject('Meeting Booked!');
        });
    }

}
