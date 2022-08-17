<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
        content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />
    {{-- websocket --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{--  --}}
        @section('title')
        تفاصيل الطلب
    @stop
    @include('layouts.head')
    <!-- Internal Data table css -->
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
    {{-- notify --}}
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
{{--  --}}
    @include('layouts.head')
</head>
<body class="main-body" style="background-color:#ecf0fa">
    <div dir="ltr">@include('include.header')</div>
    <div class="container-fluid">
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
        <div class="text-right pt-5 mt-5">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        @if (session()->has('Add'))
        <div class="text-right pt-5 mt-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif


        <!-- row opened -->
        <div class="breadcrumb-header justify-content-between pt-5 mt-5 pr-5 mr-5">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">تفاصيل الطلب</h4>
                </div>
            </div>
        </div>
        <div class="row row-sm mr-5 ml-5 pr-4 pl-4">
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

                                                    <table class="table table-striped" style="text-align:center">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">رقم الطلب</th>
                                                                <td>{{ $order->order_number }}</td>
                                                                <th scope="row">تاريخ الطلب</th>
                                                                <td>{{ $order->order_Date }}</td>
                                                                <th scope="row">تاريخ الإستلام</th>
                                                                <td>{{ $order->Due_Date }}</td>
                                                                <th scope="row">القسم</th>
                                                                <td>{{ $order->Section->name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">الخدمة</th>
                                                                <td>{{ $order->service->name }}</td>
                                                                <th scope="row">المستفيد </th>
                                                                <td>{{ $order->user }}</td>
                                                                <th scope="row">حالة الطلب </th>

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
                                                                <th scope="row">حالة الدفع </th>

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
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">سعر الخدمة</th>
                                                                <td>{{ $order->Amount_collection }}</td>
                                                                <th scope="row">ملاحظات</th>
                                                                <td>{{ $order->note }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            @if(empty($order->deleted_at))
                                            <div class="tab-pane" id="tab6">
                                                <!--المرفقات-->
                                                <div class="card card-statistics text-right">
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ url('/OrderAttachments') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="order_number"
                                                                    value="{{ $order->order_number }}">
                                                                <input type="hidden" id="order_id" name="order_id"
                                                                    value="{{ $order->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
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
                                                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>

                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="{{ $attachment->file_name }}"
                                                                            data-order_number="{{ $attachment->order_number }}"
                                                                            data-id_file="{{ $attachment->id }}"
                                                                            data-target="#delete_file">حذف</button>

                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        @endif
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
        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('provider_delete_file') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p class="text-center">
                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                            </p>


                            <input type="hidden" name="id_file" id="id_file" value="">
                            <input type="hidden" name="file_name" id="file_name" value="">
                            <input type="hidden" name="order_id" id="order_number" value="">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
        <!-- Container closed -->
    <script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var order_number = button.data('order_number')
            var modal = $(this)

            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #order_number').val(order_number);
        })
    </script>
{{--مشان ضمن الفيو --}}
<script src=" {{URL::asset('js/app.js')}}"></script>
</body>
</html>




