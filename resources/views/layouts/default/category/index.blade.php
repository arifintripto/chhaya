@extends('layouts.default.master')
@section('title',$category->title)
@section('content')
<div style="background: url({{ asset('uploads/images/'.$category->banner)}}) bottom center no-repeat; background-size:cover;"  class="section banner-page services">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="title-page">{{ $title }}</div>
            </div>
        </div>
    </div>
</div>
<div class="section services section-border">
    <div class="container">
        <div class="row grid-item">
            @foreach($products as $product)    
                <div class="col-sm-6 col-md-4">
                    <div class="box-image-1">
                        <div class="image">
                        <a href="{{ route('product.view',$product->slug)}}" title="{{ $product->title }}">
                            <img src="{{ asset('uploads/images/'.$product->thumbnail) }}" alt="" class="img-responsive">
                        </a>
                        </div>
                        <div class="description">
                            <h3 class="blok-title">{{ $product->title }}</h3>
                            <a href="{{ route('product.view',$product->slug)}}" title="GET A QUOTE" class="btn btn-secondary">VIEW DETAILS</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection