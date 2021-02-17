@extends('layouts.default.master')
@section('content')
@section('title',$title)
<style>
.failed{
    padding: 200px 0;   
}
</style>

<section class="failed container">
    <p class="text-center"><img width="120px;" src="{{asset('/uploads/images/failed.png')}}" alt="failed"></p>
    <h3 class="text-center">We are Sorry! Payment is Failed.</h3>
    <p class="text-center">We are unable to charage funds from your account for this transaction (Transaction ID : {{ $tx_id ?? ''}}). Please try again later. For futher details, please contact us through live chat or call us <a href="tel:+8801773482668">+8801773482668</a> or email us at <a href="mailto:info@chhaya.xyz">info@chhaya.xyz</a> </p>
</section>
@endsection