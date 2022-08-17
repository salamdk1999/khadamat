@extends('layouts.master')
@section('title')
    الطلبات المنفذة
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!-- مشان ال model-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الطلبات المنفذة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('archive_order'))
<script>
    window.onload = function() {
        notif({
            msg: "تم أرشفة الطلب بنجاح",
            type: "success"
        })
    }

</script>
@endif
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>

                                <th class="wd-15p border-bottom-0">رقم الطلب  </th>
                                    <th class="wd-10p border-bottom-0">تاريخ الطلب </th>
                                    <th class="wd-10p border-bottom-0">تاريخ التسليم</th>
                                    <th class="wd-10p border-bottom-0"> القسم </th>
                                    <th class="wd-10p border-bottom-0">الخدمة </th>
                                    <th class="wd-10p border-bottom-0">حالةالخدمة </th>
                                    <th class="wd-10p border-bottom-0">أرشفة الطلب </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)

                                    <tr>

                                       <td>{{ $order->order_number }} </td>
                                        <td>{{ $order->order_Date }}</td>
                                        <td>{{ $order->Due_Date }}</td>
                                        <td>{{ $order->section->name }}</td>
                                        <td>{{ $order->service->name}}</td>
                                        @if(!empty($order->service->deleted_at))
                                        <td class="text-danger">لقد تم حذف هذه الخدمة </td>
                                        @else
                                        <td class="text-success" >الخدمة موجودة وفعالة</td>
                                        @endif
                                        <td>
                                        <a class="btn btn-outline-info btn-sm " data-order_id="{{ $order->id }}"
                                            data-toggle="modal" data-target="#Transfer_order">
                                            أرشفة الطلب</a>
                                </div>

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
    <!-- Container closed -->
    <!-- main-content closed -->

    <div class="modal fade" id="Transfer_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفة الطلب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('orders.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الارشفة ؟
                    <input type="hidden" name="order_id" id="order_id" value="">
                    <input type="hidden" name="id_page" id="id_page" value="2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-success">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#Transfer_order').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var order_id = button.data('order_id')
            var modal = $(this)
            modal.find('.modal-body #order_id').val(order_id);
        })

    </script>

@endsection

