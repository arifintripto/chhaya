@extends('layouts.app')
@section('content')
<script type="text/javascript" src="{{ asset('concave5/js/plugins/highcharts/code/highcharts.js') }}"></script>
<style>
    .box_design {
        background: #fff;
        padding: 40px 20px;
        margin: 15px 0;
        box-shadow: 1px 2px 3px 1px #bdbdbd;
        min-height: 186px;
        border-radius: 10px;
    }
    .box_design2 {
        background: #fff;
        padding: 20px;
        box-shadow: 1px 2px 3px 1px #bdbdbd;
        min-height: 402px;
        border-radius: 10px;
    }
    .balance span {
        color: #48ae71;
        font-weight: bold;
        font-size: 14px;
    }
    .balance p{
        margin-bottom:0px;
    }
    .balance p b{
        font-weight:600;
    }
    .box_title {
        text-align: center;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        background: #48ae71;
        padding: 6px 17px;
        color: #fff;
        border-radius: 30px;
        text-transform:uppercase;
    }
    .box_design a {
        color: #48ae71;
    }
    #revenue_data {
        box-shadow: 1px 2px 3px 1px #bdbdbd;
        border-radius: 10px;
        background:#fff;
    }
    .pk_title {
        text-transform: uppercase;
        font-size: 18px;
        font-weight: 400;
    }
    .highcharts-title {
        text-transform: uppercase;
    }
 </style>
<div class="page-header">
	<h2>Dashboard <small> Manage your web application  </small></h2>
	<h2 class="float-right ml-5"><i class="fa fa-globe"></i>&nbsp;&nbsp;<a target="_blank" href="/">Visit Website</a></h2>
</div>

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('failed'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('failed') !!}</li>
        </ul>
    </div>
@endif




@if(\Auth::user()->group_id == 7)
@include('dashboard/user')
@elseif(\Auth::user()->group_id == 5)
@include('dashboard/agent')
@elseif(\Auth::user()->group_id == 1 || \Auth::user()->group_id == 2)
@include('dashboard/administrator')
@endif

@stop