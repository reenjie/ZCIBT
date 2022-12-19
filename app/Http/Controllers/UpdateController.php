<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\Routes;
use App\Models\Column_seats;
use App\Models\Row_seats;
use App\Models\Fare_discount;
use App\Models\Travel_schedule;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index(Request $request){
     $type=$request->type;
     $id  =$request->id;

     switch ($type) {
        case 'bus':
            $busnumb = $request->busnumber;
            $seatcapacity = $request->seatcapacity;
            $perrow = $request->perrow;
            $percolumn = $request->percolumn;
            $color = $request->color;
            $company = $request->company;
            
        
            Bus::where('id',$id)->update([
                'Bus_No'=>$busnumb,
                'seating_capacity'=>$seatcapacity,
                'company'=>$company,
                'weight'=>null,
                'color'=>$color,
                'per_column'=>$percolumn,
                'per_row'=>$perrow,
            ]);


            return redirect()->route('page.index', 'busses')->with('success','Updated Successfully!');


        break;

        case 'routes':
            $from = $request->from;
            $to   = $request->to;
            $fare = $request->fare;

            Routes::where('id',$id)->update([
                'lng'=>null,
                'lat'=>null,
                'from'=>$from,
                'to' =>$to,
                'fare' =>$fare
            ]);
            return redirect()->route('page.index', 'routes')->with('success','Updated Successfully!');
        break;



        case 'farediscount':
            
            $title = $request->title;
            $discount = $request->fare;
    
            Fare_discount::where('id',$id)->update([
                'title'=>$title,
                'discount'=>$discount
            ]);
    
            return redirect()->back()->with('success','Fare Discount Updated Successfully!');

        break;


        case 'schedule':
            $schedule = $request->schedule;
            $status   = $request->status;
            $departure= $request->departure;
            $arrival  = $request->arrival;
      
            Travel_schedule::where('id',$id)->update([
              'departure'=>$departure,
              'est_arrival'=>$arrival,
              'schedule'=>$schedule,
              'status'=>$status
            ]);
      
            return redirect()->route('page.index', 'schedules')->with('success','Schedule Updated Successfully!');
        break;
        
     
     }

    }
}
