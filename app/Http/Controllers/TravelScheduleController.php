<?php

namespace App\Http\Controllers;

use App\Models\Travel_schedule;
use App\Models\trip;
use App\Models\Bus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TravelScheduleController extends Controller
{
  
    public function store(Request $request)
    {
      $schedule = $request->schedule;
      $status   = $request->status;
      $departure= $request->departure;
      $arrival  = $request->arrival;
      $esttraveltime = $request->esttraveltime;
      $remarks = $request->remarks;
      $bustype = $request->bustype;

      Travel_schedule::create([
        'bustype'=>$bustype,
        'departure'=>$departure,
        'est_arrival'=>$arrival,
        'schedule'=>$schedule,
        'est_traveltime'=>$esttraveltime,
        'remarks'=>$remarks,
        'status'=>$status
      ]);

      return redirect()->route('page.index', 'schedules')->with('success','Schedule Saved Successfully!');
    }

    
    public function storetrips(Request $request){
        $bus = $request->bus;
        $route = $request->route;
        $schedule = $request->schedule;

     

         $check = trip::where('bus_id',$bus)->where('routes_id',$route)->where('TS_id',$schedule)->get();
         $check2 = trip::where('bus_id',$bus)->where('TS_id',$schedule)->get();
         if(count($check)>=1){
          // return redirect()->back()->with('error','Bus Trip already Exist!');
          echo 'bus trip exist';
        }else {

            if(count($check2)>=1){
                // return redirect()->back()->with('error','Bus Trip already Exist!');

                echo 'bus trp exist';
            }else {
                    $busbustype = Bus::findorFail($bus)->bustype;
                    $schedbustype = Travel_schedule::findorFail($schedule)->bustype;

                    if($busbustype == $schedbustype){
             trip::create([
                'bus_id'=>$bus,
                'TS_id'=>$schedule,
                'routes_id'=>$route
            ]);
                
            return redirect()->route('page.index', 'trips')->with('success','Trip Saved Successfully!');
                    }else {
                          return redirect()->back()->with('error','Bus Types Does not match with set schedule. please make sure it matches');
                    }



        
            }



        
        }

/* 
       */
        
    }
}
