<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Column_seats;
use App\Models\Row_seats;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $busnumb = $request->busnumber;
      $seatcapacity = $request->seatcapacity;
      $perrow = $request->perrow;
      $percolumn = $request->percolumn;
      $color = $request->color;
      $company = $request->company;

     

           $b = Bus::create([
                'Bus_No'=>$busnumb,
                'seating_capacity'=>$seatcapacity,
                'company'=>$company,
                'weight'=>null,
                'color'=>$color,
                'per_column'=>$percolumn,
                'per_row'=>$perrow,
            ]);

          $newbusid =  $b->id;

            $seats = $perrow * $percolumn;
            //save row seats
            for ($i=1; $i <= $perrow ; $i++) { 
               $row =  Row_seats::create([
                    'bus_id'=>$newbusid,
                    'row'=>$i,
                ]);

               $rowid[] = $row->id;


            }

            
            $count = 1;
          
                for ($j=1; $j <= $percolumn ; $j++) { 

                    foreach ($rowid as $key => $value) {
                      Column_seats::create([
                      'bus_id'=>$newbusid,
                           'column'=>$j,
                           'rowseat_id'=>$value,
                           'seatnumber'=>$count++
                       ]);
       
                   }
                 
                 
   
                 
               }
            

             
        
            
          

        return redirect()->route('page.index', 'busses')->with('success','Saved Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
