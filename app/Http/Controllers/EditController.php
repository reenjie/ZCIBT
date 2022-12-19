<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request){
       $type= $request->type;
       $id  = $request->id;
       $data = $request->data;

       $UpdateData = [];
       foreach ($data as $key => $value) {
        if($value['id'] == $id){
            $UpdateData = $value;
        }
      
    }

       switch ($type) {
        case 'bus':
          
            return view('action.updatebus',compact('UpdateData'));
        
        break;

        case 'routes':
            return view('action.updateroutes',compact('UpdateData'));
        break;
        

        case 'schedule':
            return view('action.updateschedule',compact('UpdateData'));
        break;
     
       }
    }
}
