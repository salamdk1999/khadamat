@extends('layouts.master_ser')
@section('content')
<div dir="rtl" class="container-sm">
<div class="row row-sm d-flex justify-content-center pt-2 mt-2">
<div class="tab-pane">
    <div class="row align-items-center vh-100">
        <div class="col-sm-4 mx-auto">
            <div class="border-10 p-1 card thumb">
                <a href="#" class="image-popup" title="Screenshot-2"> <img
                        src=" /{{ $services->image }}" class="thumb-img"
                        alt="work-thumbnail"> </a>
                <h4 class="text-center tx-20 mt-3 mb-0"><a href=""> {{$services->name}}</a> </h4>
                <div class="ga-border"></div>
                <p class="text-muted text-center"><a href="{{ url('provider_profile') }}/{{ $services->provider->id }} }}"> {{$services->provider->name}} </a></p>
            </div>
        </div>
        <div class="col-sm-4 ">
            <div class="border shadow border-primary p-1 card thumb">
                    <div class="card-body ">
                        @if( $services->status == 'معلقة')
                        <p class="card-text  text-dark">الخدمة ما زالت معلقة وفي انتظار موافقة الأدمن عليها,عندما يتم قبولها سوف يتم عرضها في خدمات  الموقع لتظهر للأخرين</p>
                        @else
                        <p class="card-text  text-dark">  تم قبول خدمتك من الأدمن , وتم عرضها في خدمات الموقع,أطلع على طلباتي لترى من قام بشراء خدمتك </p>
                        @endif

                    </div>
                </div>
            </div>
    </div>
</div>
</div>
</div>
@endsection
