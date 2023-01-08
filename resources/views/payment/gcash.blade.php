<h6 class="text-secondary">Scan QR-Code to Pay . and save a screenshot of your receipt and upload the it below for proof of payment.</h6>

@php
$qrcode = DB::select('SELECT * FROM `qrcodes` where bus_id = 0 ');
@endphp

<div class="container">
 
        @foreach ($qrcode as $item)
        <img src="{{asset('qrcode').'/'.$item->file}}" alt="" style="width:100%" >

        <input type="hidden" name="id" value="{{$item->id}}">
        @endforeach
    
</div>




<input type="file" name="gcashreceipt" accept="image/*" required class="form-control gcashattr">


<button type="submit" class="mt-2 btn btn-info" style="float: right;">
    Upload Receipt and Mark as Paid <i class="fas fa-check-circle"></i>
</button>


