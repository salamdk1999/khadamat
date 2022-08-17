@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل الطلب
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الطلب</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
           @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('Add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


    <!-- row opened -->
<div class="row row-sm">
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الطلب</a></li>
                                            @if(empty($order->deleted_at))
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table">
                                                    <thead class="h5">
                                                        <tr>
                                                            <th >رقم الطلب</th>
                                                            <th >تاريخ الطلب</th>
                                                            <th>تاريخ الإستلام</th>
                                                            <th >الخدمة</th>
                                                            <th >القسم</th>
                                                            <th> مقدم الخدمة </th>
                                                            <th >المشتري </th>
                                                            <th >حالة الطلب </th>
                                                            <th >حالة الدفع </th>
                                                            <th >سعر الخدمة</th>
                                                            <th >ملاحظات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $order->order_number }}</td>
                                                            <td>{{ $order->order_Date }}</td>
                                                            <td>{{ $order->Due_Date }}</td>
                                                            <td>{{ $order->service->name }}</td>
                                                            <td>{{ $order->Section->name }}</td>
                                                            <td> {{$order->service->provider->name}} </td>
                                                            <td>{{ $order->user }}</td>
                                                            @if ($order->Value_OrderStatus == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $order->OrderStatus }}</span>
                                                                </td>
                                                            @elseif($order->Value_OrderStatus ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $order->OrderStatus }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $order->OrderStatus }}</span>
                                                                </td>
                                                            @endif
                                                            @if ($order->Value_PaymentStatus == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $order->PaymentStatus }}</span>
                                                                </td>
                                                            @elseif($order->Value_PaymentStatus ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $order->PaymentStatus }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $order->PaymentStatus }}</span>
                                                                </td>
                                                            @endif
                                                            <td>{{ $order->Amount_collection }}</td>
                                                            <td>{{ $order->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            @if(empty($order->deleted_at))
                                            <div class="card card-statistics">
                                                <br>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">#</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">الإجراءات </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($attachments as $attachment)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->Created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td>
                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('open') }}/{{ $order->order_number }}/{{ $attachment->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض
                                                                        </a>

                                                                            <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download') }}/{{ $order->order_number }}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>
                                                                        </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>
</div>
<!-- /row -->

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
