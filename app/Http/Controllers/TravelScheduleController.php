<?php

namespace App\Http\Controllers;

use App\Models\Travel_schedule;
use App\Models\trip;
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

      Travel_schedule::create([
        'departure'=>$departure,
        'est_arrival'=>$arrival,
        'schedule'=>$schedule,
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
            return redirect()->back()->with('error','Bus Trip already Exist!');
        }else {

            if(count($check2)>=1){
                return redirect()->back()->with('error','Bus Trip already Exist!');
            }else {
                trip::create([
                'bus_id'=>$bus,
                'TS_id'=>$schedule,
                'routes_id'=>$route
            ]);
    
            return redirect()->route('page.index', 'trips')->with('success','Trip Saved Successfully!');
            }



        
        }

/* 
       */
        
    }
}
