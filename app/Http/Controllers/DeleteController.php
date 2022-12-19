<?php

namespace App\Http\Controllers;
use App\Models\Bus;
use App\Models\Routes;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Travel_schedule;
use App\Models\Column_seats;
use App\Models\Row_seats;
use App\Models\Fare_discount;
use App\Models\trip;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function index(Request $request){
       $type = $request->type;
       $id   = $request->id;

      switch ($type) {
        case 'bus':
            Column_seats::where('bus_id',$id)->delete();
            Row_seats::where('bus_id',$id)->delete();
            Bus::where('id',$id)->delete();
        break;

        case 'routes':
            Routes::where('id',$id)->delete();
        break;
        

        case 'farediscount':
          Fare_discount::where('id',$id)->delete(); 
        break;

        case 'schedule':
          Travel_schedule::where('id',$id)->delete();
        break;
        

        case 'trip':
          trip::where('id',$id)->delete();
        break;
      }
      return redirect()->back()->with('success','Data Successfully Deleted');
    }
}
