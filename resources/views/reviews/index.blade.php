@extends('layouts.master_ser')
@section('title',"كتابة رأي عن الخدمة")
@section('content')
<div class="container">
    <div class="row pt-5 mt-5">
        <div class="col-md-12 pt-2">
            <div class="card">
                <div class="card-body" dir="rtl">
                    @if($verifed_purchace)
                        <h5 class="text-right">{{$service->name}}</h5>
                        <form action="{{url('/add-review')}}" method="POST">
                            @csrf
                            <input type="hidden" name="service_id" value="{{$service -> id}}">
                            <textarea class="form-control" name="user_review" rows="5" placeholder="اكتب رأيك في الخدمة التي قمت بشراءها"></textarea>
                            <div class="pt-3 text-right" dir="rtl">
                                <button class="btn btn-primary" type="submit">نشر الرأي</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger text-right" dir="ltr">
                            <h5>لا يمكنك إبداء رأيك في الخدمة قبل شراءها</h5>
                            <a href="{{url('profile/'.$service->id.'/'.$service -> provider -> id)}}" class="btn btn-primary">عودة الى الخلف</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
