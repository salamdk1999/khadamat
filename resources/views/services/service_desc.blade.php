@extends('layouts.master_ser')
@section('content')
@if (session()->has('buyer_rate'))
<div class="pt-5 mt-5">
    <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
        {{ session()->get('buyer_rate') }}
    </div>
</div>
@endif
@if (session()->has('user_rate'))
<div class="pt-5 mt-5">
    <div class=" alert alert-danger alert-dismissible fade show text-right" role="alert">
        {{ session()->get('user_rate') }}
    </div>
</div>
@endif
@if (session()->has('no_rate'))
<div class="pt-5 mt-5">
    <div class=" alert alert-danger alert-dismissible fade show text-right" role="alert">
        {{ session()->get('no_rate') }}
    </div>
</div>
@endif
@if (session()->has('buyer_review'))
<div class="pt-5 mt-5">
    <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
        {{ session()->get('buyer_review') }}
    </div>
</div>
@endif

@if (session()->has('update_review'))
<div class="pt-5 mt-5">
    <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
        {{ session()->get('update_review') }}
    </div>
</div>
@endif
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{url('/add_rating')}}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{$service->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" dir="rtl">{{$service->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if($user_rating)
                                @for($i=1; $i<= $user_rating->stars_rated; $i++)
                                    <input type="radio" value="{{$i}}" name="service_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                @for($j=$user_rating->stars_rated+1; $j<=5; $j++)
                                    <input type="radio" value="{{$j}}" name="service_rating" id="rating{{$j}}">
                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                @endfor
                            @else
                                <input type="radio" value="1" name="service_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="service_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="service_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="service_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="service_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ التقييم</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row pt-5 mt-5">
        @hasanyrole('customer|provider')
        <div class="col-md-4 pt-2">
            <a class="btn btn-primary font-weight-bold" href="{{url('user_order/create')}}/{{ $service->id }}" role="button">
                اشتري الخدمة <span class=" bi bi-cart3">
                </span></a>
        </div>
        @endhasanyrole
        <div class="col-md-8 px-3">
            <div class="title h4 text-right" dir="rtl">{{$service -> name}}</div>
        </div>
    </div>
    <!-- Card Start -->
    <div class="row pt-3">
        <div class="col-md-5 px-3">
            <div class="card" dir="rtl">
                <div class=" card-block px-6">
                    <h4 class="card-title text-right">بطاقة الخدمة</h4>
                    <hr style="border: 1px solid black;">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0 mx-1">التقييمات</h6>
                        </div>
                        <div class="col-sm-9 text-secondary pl-5 rating">
                            <?php $ratenum=number_format($rating_value) ?>
                            <span class="rating" dir="ltr">
                                @for($i=1; $i<=$ratenum; $i++)
                                    <i class="fa fa-star checked"></i>
                                @endfor
                                @for($j=$ratenum+1; $j<=5; $j++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </span>
                            <span>({{$ratings -> count()}})</span>
                        </div>
                    </div>
                    <hr>
                    <div class=" row">
                        <div class="col-sm-3">
                            <h6 class="mb-0 mx-1">المشتريين</h6>
                        </div>
                        <div class="col-sm-9 text-secondary pl-5">{{$buyers}}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0 mx-2">طلبات جاري تنفيذها</h6>
                        </div>
                        <div class="col-sm-8 text-secondary pl-5">
                            {{$orders_not_fininsh}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">سعر الخدمة</h6>
                        </div>
                        <div class="col-sm-9 text-secondary pl-5">
                            {{$service -> price}}
                        </div>
                    </div>
                    <hr style="border: 1px solid gray;">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-2 font-weight-bold">صاحب الخدمة</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="pr-3">
                                <div class="circular--portrait">
                                    <img src="{{$service ->provider->avatar}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 text-right pt-2">
                            <span class="font-weight-bold">{{$service ->provider->name}}</span>
                            <div class="pt-2"><a href="/chat" class="btn btn-outline-primary btn-sm">تواصل</a></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="pt-5" dir="rtl"> --}}
                <div class="card" dir="rtl">
                    <div class=" card-block px-8 pl-5 ml-5">
                        <span class="pl-3"><button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal">تقييم الخدمة</button></span>
                        <a href="{{url('add-review/'.$service->id.'/userreview')}}" class="btn btn-primary">اكتب رأيك عن الخدمة</a>
                    </div>
                </div>
            {{-- </div> --}}
        </div>


            <!-- Carousel start -->
        <div class="col-md-7">
            <div class="card">
                <img class="mx-auto d-block pt-4" src=" /{{$service->image}}" width="600" height="500"
                    alt="{{$service->name}}">
                <p class="pt-5 px-4 text-right" dir="rtl">{{$service->description}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
        </div>
        <div class="col-md-7 pt-3">
            <div class="card">
                <div class="text-right pt-3 px-2" dir="rtl">
                    <h5 class="font-weight-bold">آراء المشتريين</h5>
                </div>
                <hr>
                @foreach($reviews as $item)
                    <div class="user-review text-right pr-3 pt-2">
                        @if($item->user_id == Auth::user()->id)
                            <a href="{{url('edit-review/'.$service->id.'/userreview')}}" class="pr-3">تعديل الرأي</a>
                        @endif
                        <h5 class="text-right d-inline" dir="rtl">{{$item->user->name}}</h5>
                        <br>
                        @if($item->rating)
                            <?php $user_rated=$item->rating->stars_rated?>
                            <p class="rating" dir="ltr">
                                @for($i=1; $i<=$user_rated; $i++)
                                    <i class="fa fa-star checked"></i>
                                @endfor
                                @for($j=$user_rated+1; $j<=5; $j++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </p>
                        @endif
                        <div style="padding-top: -1px">
                            <small class="text-right text-secondary">{{$item->created_at->format('d M Y')}} تمت المراجعة في</small>
                        </div>
                        <h6 class="pt-2" dir="rtl">{{$item->user_review}}</h6>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>

    <!-- End of carousel -->
</div>
<!-- End of card -->

<br>
<br>
@endsection
