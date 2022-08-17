@extends('layouts.master_ser')
@section('content')
<div dir="rtl" class="row align-items-center text-right vh-100 ">
    <div class="col-xl-8 mx-auto">
        <div class="card border-2 border-primary shadow">
            <div class="card-header ">
            <div class="card-body">
                <div class="container">
                    <table class="table">
                        <thead class="h6">
                            <tr>
                                <th>#</th>
                                <th >أسم المرفق  </th>
                                <th >قام بالاضافة</th>
                                <th >تاريخ أضافته</th>
                                <th >فتح </th>
                                <th>تحميل</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach($attachments as $attachment)
                    <?php $i++; ?>
                        <tr>
                            <td> {{$i}} </td>
                            <td> {{$attachment->file_name}} </td>
                            <td>{{ $attachment->Created_by }}</td>
                            <td> {{$attachment->created_at}} </td>
                            <td>
                                <a class="btn btn-outline-info btn-sm"
                                href="{{ url('open') }}/{{ $attachment->order_number }}/{{ $attachment->file_name }}"
                                role="button">
                                فتح </a>
                            </td>
                            <td>
                                <a class="btn btn-outline-info btn-sm"
                                href="{{ url('download') }}/{{ $attachment->order_number }}/{{ $attachment->file_name }}"
                                role="button">تحميل</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

                <div class="d-flex justify-content-center mt-2">
                    <a class="btn btn-outline-info" href=" {{url('customer_order')}} "> رجوع </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
