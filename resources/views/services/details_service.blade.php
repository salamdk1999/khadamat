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
    تفاصيل الخدمة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصيل الخدمة </h4>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


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
                                                    الخدمة</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="row align-items-center vh-50">
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

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">اسم الخدمة</th>
                                                            <th scope="row">اسم مقدم الخدمة</th>
                                                            <th scope="row">القسم</th>
                                                            <th scope="row">حالة الخدمة </th>

                                                        </tr>

                                                        <tr>
                                                            <td>{{ $services->name }}</td>
                                                            <td>{{ $services->provider->name }}</td>
                                                            <td>{{ $services->Section->name }}</td>

                                                            @if ($services->Value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $services->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $services->status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">  سعر الخدمة</th>
                                                            <th scope="row">وصف الخدمة</th>
                                                            <th></th>
                                                            <th scope="row">إجراءات الأدمن</th>



                                                        </tr>
                                                        <tr>
                                                            <td>{{ $services ->price}} </td>
                                                            <td>{{ $services->description }}</td>
                                                            <td></td>
                                                            @can('قبول ورفض الخدمات')

                                                            <td>
                                                                    <a  class="btn btn-outline-success btn-sm "
                                                                    href="{{url('approval',$services->id)}}">قبول
                                                                    </a>

                                                                    <a  class="btn btn-outline-danger btn-sm "
                                                                    href="{{url('cancel',$services->id)}}">رفض
                                                                    </a>
                                                            </td>
                                                        @endcan

                                                        </tr>



                                                    </tbody>
                                                </table>

                                            </div>
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
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
@endsection
