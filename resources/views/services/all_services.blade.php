@extends('layouts.master_ser')
@section('content')
<div dir="rtl" class="row row-sm d-flex justify-content-center pt-4 mt-5">
    {{--  --}}
    <div class="container">
        <div class="search">
            <form class="input-group" action="{{ route('all_services') }}" method="GET">
                <input type="text" name="search" id="search" placeholder="ابحث عن الخدمة التي تريدها" class="form-control" value="{{ request()->query('search') }}">
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                </div>
            </form>
        </div>
    </div>
    {{--  --}}
<div class="tab-pane" id="profile">
    <div class="row">
        @if(isset($services))
        @foreach($services as $service)
            <div class="col-sm-2">
                <div class="border p-1 card thumb">
                    <a class="image-popup" title="{{ $service->name }}" href="{{url('profile/'.$service->id.'/'.$service -> provider -> id)}}"><img
                            src="{{ $service->image }}" class="thumb-img"
                            alt="work-thumbnail"> </a>
                    <h4 class="text-center tx-17 mt-3 mb-0"><a href="{{url('profile/'.$service->id.'/'.$service -> provider -> id)}}"> {{$service->name}} </a> </h4>
                    <div class="ga-border"></div>
                    <p class="text-muted text-center"><small><a href="{{ url('user_profile') }}/{{ $service->provider->id }} }}"> {{$service->provider->name}} </a></small></p>
                    @if($service->ratings->count() > 0)
                                        <p class="text-center">
                                            <?php $ratenum=number_format($service->ratings->avg('stars_rated'))?>
                                            <span class="rating" dir="ltr">
                                                @for($i=1; $i<=$ratenum; $i++)
                                                    <i class="fa fa-star checked"></i>
                                                @endfor
                                                @for($j=$ratenum+1; $j<=5; $j++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </span>
                                            <span class="text-muted">({{$service->ratings->count()}})</span>
                                        </p>
                                    @endif
                </div>
            </div>
        {{-- @empty --}}
        {{-- <p class="text-center pt-5">للأسف،  لم يتم العثور على نتائج تطابق بحثك.تأكد من التهجئة أو جرب كلمة أخرى.</p> --}}
        @endforeach
        @endif
        @if($services_c == '0')
        <p class="text-center pt-5">للأسف،لم يتم العثور على نتائج تطابق بحثك.تأكد من التهجئة أو جرب كلمة أخرى</p>
        @endif
    </div>
</div>
@endsection
