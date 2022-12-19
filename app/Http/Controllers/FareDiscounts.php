<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fare_discount;

class FareDiscounts extends Controller
{
    
    public function store(Request $request){
       
        $title = $request->title;
        $discount = $request->fare;

        Fare_discount::create([
            'title'=>$title,
            'discount'=>$discount
        ]);

        return redirect()->back()->with('success','Fare Discount Saved Successfully!');
    }
}
