<!DOCTYPE html lang="ar" dir="rtl">
<html >

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
        @section('title')
    الطلبات
    @endsection
    <!-- Internal Data table css -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Work+Sans:ital,wght@0,600;0,800;1,200;1,500&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />


    <link href="assets2/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets2/css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.head')

</head>

<body class="main-body" style="background-color:#ecf0fa">
    <div dir="ltr">@include('include.header')</div>
    <div class="container-fluid">
        @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session()->has('delete_order'))
        <div class="pt-5 mt-5">
            <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
                {{ session()->get('delete_order') }}
            </div>
        </div>
        @endif
        @if (session()->has('not_delete_order'))
        <div class="pt-5 mt-5">
            <div class=" alert alert-danger alert-dismissible fade show text-right" role="alert">
                {{ session()->get('not_delete_order') }}
            </div>
        </div>
        @endif

        @if (session()->has('status_update'))
        <div class="pt-5 mt-5">
            <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
                {{ session()->get('status_update') }}
            </div>
        </div>
        @endif

        @if (session()->has('archive_order'))
        <div class="pt-5 mt-5">
            <div class=" alert alert-success alert-dismissible fade show text-right" role="alert">
                {{ session()->get('archive_order') }}
            </div>
        </div>
        @endif
        @if (session()->has('restore_order'))
        <script>
        window.onload = function() {
            notif({
                msg: "تم استعادة الطلب بنجاح",
                type: "success"
            })
        }
        </script>
        @endif
        <!-- row -->
        <div class="breadcrumb-header justify-content-between pt-5 mt-5 mr-5 pr-5">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">جميع الطلبات</h4>
                </div>
            </div>
        </div>
        <div class="row mr-5 ml-5 pr-3 pl-3">
            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-2 text-right">
                        <a class="modal-effect btn btn-sm btn-primary" href=" {{ url('export_orders') }}"
                            style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                                style="text-align: center">
                                <thead>
                                    <tr>

                                        {{-- <th class="wd-15p border-bottom-0">رقم الطلب </th> --}}
                                        <th class="wd-12p border-bottom-0">الخدمة المطلوبة </th>
                                        <th class="wd-12p border-bottom-0">اسم الزبون</th>
                                        <th class="wd-12p border-bottom-0">تاريخ الطلب </th>
                                        <th class="wd-12p border-bottom-0">تاريخ التسليم</th>
                                        <th class="wd-12p border-bottom-0"> القسم </th>
                                        <th class="wd-12p border-bottom-0">حالة الطلب </th>
                                        <th class="wd-12p border-bottom-0">حالة الدفع</th>
                                        <th class="wd-12p border-bottom-0"> الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)

                                    <tr>
                                        <td>{{ $order->service->name}}</td>
                                        <td>{{ $order->user }} </td>
                                        <td>{{ $order->order_Date }}</td>
                                        <td>{{ $order->Due_Date }}</td>
                                        <td>{{ $order->section->name }}</td>
                                        <td>{{ $order->OrderStatus}}</td>
                                        <td> {{ $order->PaymentStatus}} </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i
                                                        class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">


                                                    @if($order->Value_PaymentStatus =='2')
                                                    <a class="dropdown-item" href="#" data-order_id="{{ $order->id }}"
                                                        data-toggle="modal" data-target="#delete_order"><i
                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;رفض
                                                        الطلب
                                                    </a>
                                                    @endif
                                                    <a class="dropdown-item"
                                                        href="{{ URL::route('provider_status_show',[$order->id]) }}">
                                                        <i class="cf cf-zec"></i> &nbsp; حالة الطلب و الدفع</a>


                                                    <a class="dropdown-item"
                                                        href="{{ url('provider_details_order') }}/{{ $order->id }}">
                                                        <i class="fas fa-eye"></i> &nbsp; تفاصيل الطلب
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        @if(!empty($order->service->deleted_at))
                                        <td class="t2">

                                            ! لقد قمت بحذف هذه الخدمة
                                        </td>

                                        @endif
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>

        <div class="modal fade" id="delete_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">رفض الطلب</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('orders.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من رفض الطلب  ؟</p><br>

                            <input type="hidden" name="order_id" id="order_id" value="">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
    <!-- row closed -->


</body>

</html>
