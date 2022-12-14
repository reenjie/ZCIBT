<?php

namespace App\Http\Controllers;

use App\Models\Qrcode;
use Illuminate\Http\Request;

class QrcodeController extends Controller
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
       dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function show(Qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function edit(Qrcode $qrcode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $id = $request->id;
        $file = $request->file('qrfile');
       
        $filename = Qrcode::findorFail($id)->file;

        // if(file_exists(public_path().'/qrcode/'.$filename)){
        //         $src = base_url().asset('qrcode').'/'.$filename;

              
        // }else{
        //          $src = base_url().asset('qrcode').'/'.$filename;

        // }
        // unlink($src);

        $qrfile = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('qrcode'), $qrfile);

        Qrcode::findorFail($id)->update([
            'file'=>$qrfile,
        ]);
         return redirect()->back()->with('success','qr code saved successfully!');   


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qrcode  $qrcode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qrcode $qrcode)
    {
        //
    }
}
