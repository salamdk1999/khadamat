@extends('layouts.master_ser')
@section('title',"تعديل الرأي")
@section('content')
<div class="container">
    <div class="row pt-5 mt-5">
        <div class="col-md-12 pt-2">
            <div class="card">
                <div class="card-body" dir="rtl">
                        <h5 class="text-right">{{$review->service->name}}</h5>
                        <form action="{{url('/update-review')}}" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            <input type="hidden" name="review_id" value="{{$review->id}}">
                            <textarea class="form-control" name="user_review" rows="5" placeholder="اكتب رأيك في الخدمة التي قمت بشراءها">{{$review->user_review}}</textarea>
                            <div class="pt-3 text-right" dir="rtl">
                                <button class="btn btn-primary" type="submit">تعديل الرأي</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
