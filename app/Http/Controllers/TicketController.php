<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\trip;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Column_seats;
use App\Models\Row_seats;
use Illuminate\Support\Facades\DB;
class TicketController extends Controller
{
 
    public function store(Request $request)
    {
        //
    }

    public function payticket(Request $request){
        $colid = $request->colid;
        $rowid = $request->rowid;
        $tripid = $request->tripid;
        $auth = $request->auth;

        $data = [
            'colid'=>$colid,
            'rowid'=>$rowid,
            'tripid'=>$tripid
        ];
        session(['reservation'=>$data]);    

        $fare = DB::select('select aircon_fare as fare from routes where id = (select routes_id from trips where id = '.$tripid.') ');

       

        return view('payment',compact('auth','fare'));

    }

    public function reserve(Request $request){
       
        $firstname = $request->firstname;
        $middlename=$request->middlename;
        $lastname = $request->lastname;
        $birthdate = $request->birthdate;
        $contactno = $request->contactno;
        $address   = $request->address;
        $email     = $request->email;
        $password  = $request->password;
        $password_confirmation = $request->password_confirmation;

      
        if($request->discount){
            $discount = $request->discount;
        }else {
            $discount = 0;
        }

       if(auth()->check()){
        if($request->file('idfile')){
            $imageName = time().'.'.$request->file('idfile')->getClientOriginalExtension();
         
            $request->file('idfile')->move(public_path('attachments'), $imageName);
        }else {
            $imageName = '';
        }

        if(session()->has('reservation')){
            $rs=session()->get('reservation');
          
             $trip =  trip::where('id',$rs['tripid'])->get();
             
             foreach ($trip as $key => $value) {
             
            $newticket = Ticket::create([
                'bus_id'=>$value->bus_id,
                'column_seat_id'=>$rs['colid'],
                'row_seat_id'=>$rs['rowid'],
                'routes_id'=>$value->routes_id,
                'ts_id'=>$value->TS_id,
                'user_id'=>Auth::user()->id,
                'idfile'=>$imageName,
                'discount'=>$discount,
                'status'=>0,
                'exp_date'=>null
            ]);

            return redirect()->route('mailticket',[
                'ticketID'=>$newticket->id,
                'type'    =>'backtobus',
                'tripid'  =>$rs['tripid'],
                'busid'   =>$value->bus_id,
            ]);
              
             }

           
            
            // return redirect()->route('viewbus',['trip_id'=>$rs['tripid'],'reserve'=>true,'id'=>$value->bus_id,'authenticathed'=>true])->with('success','Ticket Reserved Successfully!');
  
       

        }

        
       }else {
          $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
            ]);

           try {

            if($request->file('idfile')){
                $imageName = time().'.'.$request->file('idfile')->getClientOriginalExtension();
             
                $request->file('idfile')->move(public_path('attachments'), $imageName);
            }else {
                $imageName = '';
            }


            $user = User::create([
                'firstname'=>$firstname,
                'middlename'=>$middlename,
                'lastname'=>$lastname,
                'birthdate'=>$birthdate,
                'user_type'=>3,
                'license_no'=>null,
                'bus_id'=>0,
                'address'=>$address,
                'contact_no'=>$contactno,
                'fl'=>0,
                'vrfy'=>0,
                'status'=>0,
                'email'=>$email,
                'password'=>Hash::make($password),
                ]);

            $userid = $user->id;


            if(session()->has('reservation')){
                $rs=session()->get('reservation');
              
                 $trip =  trip::where('id',$rs['tripid'])->get();
                 
                 foreach ($trip as $key => $value) {
                 
                    $newticket=   Ticket::create([
                    'bus_id'=>$value->bus_id,
                    'column_seat_id'=>$rs['colid'],
                    'row_seat_id'=>$rs['rowid'],
                    'routes_id'=>$value->routes_id,
                    'ts_id'=>$value->TS_id,
                    'user_id'=>$userid,
                    'idfile'=>$imageName,
                    'discount'=>$discount,
                    'status'=>0,
                    'exp_date'=>null
                ]);
                    
                return redirect()->route('mailticket',[
                    'userid' =>$userid,
                    'ticketID'=>$newticket->id,
                    'type'    =>'login'
                ]);

                 }
                
                    
           

            }


        
                //return redirect()->route('login')->with('success','Your Ticket was Reserved Successfully!. For more information or ticket cancellation Please Login into your account . Note : No Credit Card Account information was saved, it is for development purpose only. ');
           } catch (\Throwable $th) {
           // return $th;
                echo 'Email Entered already exist in our database. please use a unique Email!';
           } 
    
       }

      
    }

    public function changeseat(Request $request){
        $id = $request->id;
        $updateid = $request->updateid;
        $busid = $request->busid;

       //invalidid

        $seats = Column_seats::where('id',$id)->where('bus_id',$busid)->get();

        $seats = DB::select('SELECT * FROM `column_seats` where id = '.$id.' and bus_id = '.$busid.' and id not in (select column_seat_id from tickets where bus_id = '.$busid.' ) ');

        if(count($seats)>=1){
            foreach ($seats as $key => $value) {
           
                $rowseat_id = $value->rowseat_id;
         
        Ticket::where('id',$updateid)->update([
            'column_seat_id'=>$id,
            'row_seat_id'   =>$rowseat_id
   ]);
            }
        }else {
            echo 'invalidid';
        }
    


        

    }


    public function actiondiscountrequest(Request $request){
      $id = $request->id;
      $discount = $request->discount;
      $type = $request->type;
      $reason = $request->reason;
     
      if($type == 'decline'){
        
        Ticket::where('id',$id)->update([
            'status'=>2,
            'reason'=>$reason
        ]);
      }else 
      {
          
        Ticket::where('id',$id)->update([
            'status'=>1,
           
        ]);
      }
    }

    public function confirm(Request $request){
        $id = $request->id;

        Ticket::where('id',$id)->update([
            'status'=>3,
           
        ]);

        return redirect()->route('page.index', 'passengers')->with('success','Confirmed Successfully!');
    }
}
