<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\oneChat;
use PharIo\Manifest\Url;
use App\Models\engCategory;
use App\Events\oneChatevent;
use Illuminate\Http\Request;
use App\Models\appointmentInfo;
use App\Services\ClientService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;


class index extends Controller
{
    public $clientservices;
    public function __construct(ClientService $clientservices)
    {
        $this->clientservices = $clientservices;
    }
    public function showindex(){
       $redirectPageName = $this->clientservices->showIndexpage();
       if($redirectPageName == 'ADMIN'){
        return redirect(RouteServiceProvider::ADMIN);
       }elseif($redirectPageName == 'ENGE'){
        return redirect(RouteServiceProvider::ENGE);
       }elseif($redirectPageName == 'ENGEFAILED'){
        dd('Your request go to Admin');
       }else{
        return redirect(RouteServiceProvider::INDEXPAGE);
       }
    }
    public function engineersearch(Request $res){
        $resultSearchEngineer = $this->clientservices->searchEnginerCategoryWise($res->id);
        return view('searchengineer.searchengineerview')->with($resultSearchEngineer);
    }
    public function registerformshow(Request $res){
        return view('auth.register')->with(['city_name'=>$res->city_name,'eng_type' =>$res->eng_type]);
    }
    public function showuserpanel(){
       
    //    $eng_type = engCategory::get('category');
    // return view('newpanel.newpanelview')->with(['engtype'=>$eng_type]);
    // dd(Route::current());
      return view('newpanel.newpanelview');
}
    public function destroy()
    {
        $this->clientservices->logoutClient();
        return redirect('/');
    }
    public function viewprofileeng(Request $res){
        $engineerComment =  $this->clientservices->viewEngineerComment($res);
        return view('engineerprofile.engineerprofileview')->with(['engr'=>$engineerComment]);
    }
    public function register_show(){
        return view('registerpage.registerpageview');
    }
    public function register_form(){
        return redirect()->back();
    }
    public function booking(Request $res){
        $engr = User::find($res->bookingid);
        return view('booking.bookingpageview')->with('engr',$engr);
    }
     public function proceed(Request $res){
        $engineerFind = User::find($res->engr_id);
        return view('proceedtopay.proceedpageview')->with(['engr'=>$engineerFind,'meetingdate'=>$res->engr_date,'meetingtime'=>$res->engr_time]);
    }
    public function loginproceed(){
        if(session()->has('path')){
            return view('proceedtopay.proceedpageview');
        }else{
            if(Auth::check()){
                return redirect()->route('userfrontpageview');
            }else{
                return redirect()->route('home');
            }
        }
    }
    public function commentmessage(Request $res){
        // $res->validate([
        //     'comment'=>'required'
        // ]);
       $engrdata = User::find($res->engr_id);
       $servicesrating = ($res->rating == null)?0:$res->rating;
       $responserating = ($res->responserating == null)?0:$res->responserating;
            if(Auth::user()->role == 'user'){
                $savecmt = Comment::create([
                    'clientid'=>Auth::user()->id,
                    'engrid'=>$res->engr_id,
                    'comment'=>$res->msg_cmt,
                    'service'=>$servicesrating,
                    'response'=>$responserating,
                ]);
                if($savecmt){
                    session()->put('cmt_engrid',$res->engr_id);
                    return redirect()->route('viewprofileeng');
                    // return view('engineerprofile.engineerprofileview')->with(array('msg'=>'Successfully save your comment','engr'=>$engrdata));
                   
                }else{
                    return view('engineerprofile.engineerprofileview')->with(array('msg'=>'Not save your comment','engr'=>$engrdata));

                }
              
            }
        
    }
     public function clientsearchengr(){ 
        $engr = User::where('role','enge')->paginate(5);
        return view('client.searchengr.searchengepageview')->with('engr',$engr);
    }
    public function conformorder(Request $res){
       $clientid = Auth::user()->id;
       $checkres = appointmentInfo::where('engrid',$res->engr_id)->where('clientid',$clientid)->where('clientstatus',0)->count();
       if($checkres > 0){
        $ress = appointmentInfo::create([
            'engrid'=>$res->engr_id,
            'clientid'=>$clientid,
            'meetingdate'=>$res->engrdate,
            'bookingfee'=>$res->bookingfee,
            'consultingfee'=>$res->consultingfee,
            'tlprice'=>$res->totalfee,
            'paymentmethod'=>$res->payment_radio,
           ]);
           if($ress){
            session()->put('conformengrid',$res->engr_id);
            session()->put('conformmeetingdate',$res->engrdate);
            return redirect()->route('conformorderpage');
           }
       }else{
        $ress = appointmentInfo::create([
            'engrid'=>$res->engr_id,
            'clientid'=>$clientid,
            'meetingdate'=>$res->engrdate,
            'bookingfee'=>$res->bookingfee,
            'consultingfee'=>$res->consultingfee,
            'tlprice'=>$res->totalfee,
            'paymentmethod'=>$res->payment_radio,
           ]);
           if($ress){
            session()->put('conformengrid',$res->engr_id);
            session()->put('conformmeetingdate',$res->engrdate);
            return redirect()->route('conformorderpage');
           }
       }
       
    }
    public function conformorderpage(){
        if(session()->has('conformengrid')){
            return view('client.successbooking.bookingpageview');
        }else{
            return redirect()->route('clientprofile');
        }
    }
    public function fetchorderinfo(appointmentInfo $id){
        $engrinfo = getuser($id->engrid);
        $clientinfo = getuser($id->clientid);
        $engrcategory = getcategoryname($engrinfo->engrcategoryid);
        $dataarray = [$id,$engrinfo,$clientinfo,$engrcategory];
        return response()->json( $dataarray);
    }
     public function clientprofile(){ 
        $order = appointmentInfo::paginate(10);
        return view('client.clientprofile.clientprofile')->with('order',$order);
    }
     public function clientprofilesetting(){ 
        return view('client.profilesetting.clientprofilepageview');
    }
     public function engineerprofile(){ 
        return view('client.profilesetting.clientprofilepageview');
    }
     public function clientchangepassword(){ 
        return view('client.changepassword.changepassword');
    }
     public function conformemailpage(){ 
        return view('conform_email.conformemailpage');
    }
    public function onegetchatmsg(Request $res){
        $getmessages = oneChat::where([['senderid',$res->senderid],['reciverid',$res->reciverid]])->orwhere([['reciverid',$res->senderid],['senderid',$res->reciverid]])->get();
        return response()->json($getmessages);
    }
    public function fetchrole(Request $res){
        $user = User::find($res->id);
        return response()->json($user->role);
    }
    public function send_message(Request $res){
        if(Auth::user()->role == 'user'){
            $ress = oneChat::create([
                'clientid'=>$res->senderid,
                'engrid'=>$res->reciverid,
                'senderid'=>$res->senderid,
                'reciverid'=>$res->reciverid,
                'message'=>$res->message,
            ]);
        }else{
            $ress = oneChat::create([
                'clientid'=>$res->reciverid,
                'engrid'=>$res->senderid,
                'senderid'=>$res->senderid,
                'reciverid'=>$res->reciverid,
                'message'=>$res->message,
            ]);
        }
       
        if($res){
            event(new oneChatevent($res->senderid,$res->reciverid,$res->message));
            return ['success'=>true];
        }
    }
     public function conformemailcode(Request $res){ 
       
        if($res->conformemail == Auth::user()->emailcode){
            User::where('id',Auth::user()->id)->update(['emailstatus'=>1]);
           return redirect(RouteServiceProvider::HOME);
        }
        else{
            return redirect()->back();
        }
    }
    public function searchspecificcategory(Request $res){
        $specific_engr = User::where('role','enge')->where('status',1)->where('emailstatus',1)->where('engrcategoryid',$res->id)->get();
        $count_tl = count($specific_engr);
        return response()->json(['data'=>$specific_engr,'tlcount'=>$count_tl]);
    }
}
