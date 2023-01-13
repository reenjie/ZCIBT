<h4 style="font-size:15px;font-weight:bold">Over the counter payment method.</h4>
@isset($selected)
@if(count($selected)>=1)

<h5 style="font-size:14px" class="text-danger">
   This Payment Method is not supported for multiple reservation of ticket.
</h5>
@else

<h6>Note <i class="fas fa-exclamatory-triangle"></i></h6>
<h5 style="font-size:14px">
    Please prepare exact amount when paying at the counter.
</h5>
<input type="hidden" name="otc" value="1">
<input type="submit" value="Reserve and pay at the counter" class="btn btn-primary">


@endif

@else 

<h6>Note <i class="fas fa-exclamatory-triangle"></i></h6>
<h5 style="font-size:14px">
    Please prepare exact amount when paying at the counter.
</h5>
<input type="hidden" name="otc" id="otc" value="1">
<input type="submit" value="Reserve and pay at the counter" class="btn btn-primary">

@endisset
