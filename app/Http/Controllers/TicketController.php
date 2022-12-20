<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
 
    public function store(Request $request)
    {
        //
    }

    public function payticket(Request $request){
        $colid = $request->colid;
        $rowid = $request->rowid;

        $data = [
            'colid'=>$colid,
            'rowid'=>$rowid
        ];
        session(['reservation'=>$data]);

        return view('payment');

    }
}
