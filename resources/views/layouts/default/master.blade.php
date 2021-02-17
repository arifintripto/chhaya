@php $settings = App\Models\Settings::orderBy('id','desc')->first(); @endphp
@include('layouts.default.header')

@if(session()->has('success'))
<style>
    .alert-dismissible.container {
        position: fixed;
        display: block;
        z-index: 99;
        transform: translateX(-50%);
        background: #e90808f2;
        left: 50%;
        width: 100%;
        border-radius: 0;
    }
    .alert-success {
        color: #fff;
        background-color: #0b9545;
        border-color: transparent;
    }
</style>

    <div class="alert alert-success alert-dismissible container">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! session()->get('success') !!}
    </div>
@endif



@if(session()->has('failed'))
<style>
    .alert-dismissible.container{
        position: fixed;
        display: block;
        z-index: 99;
        transform: translateX(-50%);
        background: #f00;
        left: 50%;
    }
    .alert-danger {
        color: #fff;
        background-color: #f00;
        border-color: transparent;
    }
</style>

    <div class="alert alert-danger alert-dismissible container">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! session()->get('failed') !!}
    </div>
@endif

@yield('content')
@include('layouts.default.footer')