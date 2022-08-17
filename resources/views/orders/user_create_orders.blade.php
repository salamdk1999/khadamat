@extends('layouts.master_ser')



@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection



<!-- row -->
<div dir="rtl" class="row align-items-center vh-100 ">
<div class="col-lg-10 col-md-10 mx-auto">
    <div class="card mt-5 border-2 border-primary shadow-5 ">
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                {{-- 1 --}}
                <div dir="rtl"  class="row">

                    <div class="col text-right">
                        <label>
                            <h5 class="text-dark" >تاريخ الطلب</h5>

                            </label>
                        <input class="form-control border-dark fc-datepicker" name="order_Date" placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}" required readonly>
                    </div>
                    <div class="col text-right">
                        <label>
                            <h5 class="text-dark" >  تاريخ التسليم </h5>
                        </label>
                        <input class="form-control border-dark" name="Due_Date" placeholder="حدد تاريخ التسليم الذي تريده " type="datatime_local" required>
                    </div>

                </div>
                {{-- 2 --}}
                <div class="row mt-3">
                    <div class="col text-right ml-3 form-control">
                        <label for="section_name">
                        <h5 class="text-dark" > القسم</h5>
                    </label>
                    <input type="hidden" class="form-control" name="section_id" value="{{$services->section->id}} ">
                    <input type=" text" class="form-control border-dark" id="section_name"
                                name="section_name" value="{{$services ->section->name}}" readonly>
                    </div>

                    <div class="col text-right ml-3 form-control">
                        <label for="service_name">
                            <h5 class="text-dark" > أسم الخدمة</h5>
                        </label>
                        <input type="hidden" class="form-control" name="service_id" value="{{$services->id}} ">
                        <input type="hidden" class="form-control" name="provider_id" value="{{$services->service_provider_id}} ">
                        <input type=" text" class="form-control border-dark" id="service_name"
                                    name="service_name" value="{{$services->name}}" readonly>
                    </div>

                    <div class="col text-right  ml-3 form-control">
                        <label for="service_price">
                            <h5 class="text-dark" >سعر الخدمة </h5>
                        </label>
                        <input type=" text" class="form-control border-dark" id="service_price"
                                    name="service_price" value="{{ $services->price }}" readonly>
                    </div>
                    <div class="col text-right form-control">
                        <label for="provider_name">
                        <h5 class="text-dark" > أسم مقدم الخدمة</h5>
                    </label>
                    <input type=" text" class="form-control border-dark" id="provider_name"
                                name="name" value="{{$services ->provider ->name}}" readonly>
                    </div>

                </div>
                {{-- 3 --}}
                <div class="row">

                    <div class="col text-right mt-3">
                        <label for="exampleTextarea"> <h5 class="text-dark" > ملاحظات </h5></label>
                        <textarea class="form-control border-dark" id="exampleTextarea" name="note" rows="4"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-right  mt-3">
                        <h5 class="text-dark t-15">يمكنك رفع أي ملف لمقدم  الخدمة:</h5>
                            <label class="btn btn-default btn-primary">
                            <input type="file" class="form-control" name="file_name"  hidden>  أرفع  </label>
                    </div>
                    </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">شراء هذه الخدمة </button>
                </div>


            </form>
        </div>
    </div>



@if (session()->has('Add'))
<div  class="alert alert-success alert-dismissible fade show" role="alert">
    <strong >{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif



@if (session()->has('eror'))
<div  class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong ><h1 class="t-10"> {{ session()->get('eror') }} </h1></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
</div>


</div>


<!-- row closed -->

