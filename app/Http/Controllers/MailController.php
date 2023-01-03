<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MailController extends Controller
{
    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;

    public function __construct()
    {
       
     
        $this->client_id        = env('GOOGLE_API_CLIENT_ID');
        $this->client_secret    = env('GOOGLE_API_CLIENT_SECRET');
        $this->provider         = new Google(
            [
                'clientId'      => $this->client_id,
                'clientSecret'  => $this->client_secret
            ]
        );

    }

    public function sendcredentials(Request $request){
        $receiver = $request->email;
        $name = $request->name;
        $pass = $request->password;
        $this->token = '1//0elheUqcXeJ1gCgYIARAAGA4SNwF-L9IrQYSrJwOnRwgdEGtZxCZPWPynsDaoEHzUXP-VqGKkf1xOE5Dx90gsmr4tjwjSctzuV6o';
        $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => '1//0elheUqcXeJ1gCgYIARAAGA4SNwF-L9IrQYSrJwOnRwgdEGtZxCZPWPynsDaoEHzUXP-VqGKkf1xOE5Dx90gsmr4tjwjSctzuV6o',
                       'userName'          => 'capstone0223@gmail.com'
                   ]
               )
           );

           $mail->setFrom('capstone0223@gmail.com','NoReply@Ed-detection');
           $mail->addAddress('reenjie17@gmail.com','Reenjay');
           $mail->Subject = 'ONE TIME PIN';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body >
           
           
                   <h4>Your one-Time-pin is</h4>
           
           
                       
                        <h1>462123</h1>
                
                   <br>
                   <h5>
                       Do not share this to anyone.
                       <br>
           
                       All rights Reserved &middot; 2022
           
                   </h5>
                   <p><br><br><br></p>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
          echo 'send';
           } else {
            echo 'not send';
             //  return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
        return $e;
        //   return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  

    }

    public function mailticket(Request $request){
       $id = $request->ticketID;
       
    
        if(auth()->check()){
            $userid =Auth::user()->id;
        }else {
            $userid = $request->userid;
        }
       $data = DB::select('SELECT t.id,t.column_seat_id,t.discount,t.status,t.idfile ,t.reason ,
       u.firstname,u.middlename,u.lastname , u.email,
       ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
       r.from , r.to,r.aircon_fare,
       b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
       , d.title,d.discount
       from users u inner join tickets t on t.user_id = u.id 
       INNER join travel_schedules ts on ts.id = t.ts_id 
       inner join routes r on r.id = t.routes_id
       INNER JOIN buses b on b.id = t.bus_id
       LEFT JOIN fare_discounts d on d.id = t.discount where u.id = '.$userid.' and t.id = '.$id.' ');



       foreach ($data as $key => $value) {
       $email = $value->email;
       $Name  = $value->firstname.' '.$value->middlename.' '.$value->lastname;
       $from  = $value->from;
       $to    = $value->to;
       $fare  = $value->aircon_fare;
       $busno = $value->Bus_No;
       $seatno = $value->column_seat_id; 
       $departure = $value->departure;
       $arrival  = $value->est_arrival;
       $schedule = $value->schedule;
       $seatingcapacity = $value->seating_capacity;
       $percolumn = $value->per_column;
       $perrow = $value->per_row;
       $company = $value->company;

       }


       $sitno = DB::select('select * from column_seats where id = '.$seatno.' ');

       foreach ($sitno as $key => $st) {
        $seatnum = $st->seatnumber;
       }


       $mail = new PHPMailer(true);

       try {
           $mail->isSMTP();
           $mail->SMTPDebug = SMTP::DEBUG_OFF;
           $mail->Host = 'smtp.gmail.com';
           $mail->Port = 465;
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
           $mail->SMTPAuth = true;
           $mail->AuthType = 'XOAUTH2';
           $mail->setOAuth(
               new OAuth(
                   [
                       'provider'          => $this->provider,
                       'clientId'          => $this->client_id,
                       'clientSecret'      => $this->client_secret,
                       'refreshToken'      => '1//0elheUqcXeJ1gCgYIARAAGA4SNwF-L9IrQYSrJwOnRwgdEGtZxCZPWPynsDaoEHzUXP-VqGKkf1xOE5Dx90gsmr4tjwjSctzuV6o',
                       'userName'          => 'capstone0223@gmail.com'
                   ]
               )
           );

           $mail->setFrom('capstone0223@gmail.com','NoReply@ZamboIBT');
           $mail->addAddress($email,$Name);
           $mail->Subject = 'My TICKET Reservation';
           $mail->CharSet = PHPMailer::CHARSET_UTF8;
           $body = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title></title>
           </head>
           
           <body style="padding:10px" >
           <h2>
           Good Day!  '.$Name.' 
           <br>
           </h2>
           <span>Your Reserved ticket in Zamboanga Integrated Bus Terminal was Shown Below.</span>
           <br><br>
           <ul class="list-group list-group-flush" style="list-decoration:none">
        

           <li class="list-group-item bg-light mb-2 shadow-lg" style="font-size:12px;border-left:5px solid #66cbdf;border-radius:5px;padding:10px">
<div style="font-size:12px;font-weight:normal">

Bus No: '.$busno.'
<br>

'.$percolumn.' x '.$perrow.'
<br>
Seating Capacity : '.$seatingcapacity.'
<br>
'.$company.'
</div>
<h2>Reference Code : '.$id.date('FYmd',strtotime($schedule)).'
<br>
Seat No: '.$seatnum.'
</h2>
<span style="font-size:11px">Present this Reference code in the bus you have selected</span>
<br>
<br>
From : '.$from.'
<br>
To   : '.$to.'
<br>
Schedule : '.date('F j, Y',strtotime($schedule)).'
<br>



Departure :'.date('h:ia',strtotime($departure)).'
<br>
Estimated Arrival : '.date('h:ia',strtotime($arrival)).'
<br>
Fare : &#8369; '.$fare.'
<br>


<br>


</li>
         


</ul>
           
           </body>
           
           </html>
           
           ';
           $mail->msgHTML($body);
           $mail->AltBody = 'This is a plain text message body';
           if( $mail->send() ) {
          if($request->type == 'backtobus'){
            return redirect()->route('viewbus',['trip_id'=>$request->tripid,'reserve'=>true,'id'=>$request->busid,'authenticathed'=>true])->with('success','Ticket Reserved Successfully!');
  
          }else{
            return redirect()->route('login')->with('success','Your Ticket was Reserved Successfully!. For more information or ticket cancellation Please Login into your account . Note : No Credit Card Account information was saved, it is for development purpose only. ');
          }
           } else {
            echo 'not send';
             //  return redirect()->back()->with('error', 'Unable to send email.');
           }
       } catch(Exception $e) {
        return $e;
        //   return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
       }  




      
    }

}