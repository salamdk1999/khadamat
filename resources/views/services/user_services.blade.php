@extends('layouts.master_ser')
@section('content')

<div dir="rtl" class="row align-items-center vh-100 ">
    <div class="col-xl-11 mx-auto">
        <div class="card mg-b-70 mg-r-70 mg-t-100">
            <div class="card-header ">
        <div class="card-body">
            <div class="container">

                @if (session()->has('Add'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Add') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif


                @if (session()->has('Edit'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Edit') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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


                @if (session()->has('msg'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('msg') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif



                @if (session()->has('noo'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('noo') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif



                @if (session()->has('Error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('Error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif


                <div class="col-sm-3 col-md-2 col-xl-2">
                    <h3><button type="button" class="btn btn-primary active btn-lg" data-toggle="modal" data-target="#myModal">إضافة خدمة </button></h3>
                </div>
                <div class="col-sm-8 col-md-6 col-xl-7">
                    <p>هنا سوف تجد الخدمات التي قمت بأضافتها سابقاً ,لأضافة خدمة جديدة لجدول خدماتك أضغت على زر أضافة خدمة </p>
                </div>
                <div class="table-responsive">
                    <table id="example1"  class="table key-buttons text-md-nowrap table-hover  table-borderless table-light table-lg  " data-page-length='50'>
                        <thead class="thead-light">
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">أسم الخدمة</th>
                            <th class="border-bottom-0"> أسم القسم</th>
                            <th class="border-bottom-0">مقدم الخدمة </th>
                            <th class="border-bottom-0">حالة الخدمة</th>
                            <th class="border-bottom-0"> السعر المتوقع </th>
                            <th class="border-bottom-0">وصف الخدمة</th>
                            <th class="border-bottom-0 ">العمليات</th>
                        </thead>
                    <tbody>

                        <?php $i = 0; ?>
                        @foreach  ( $services as $service)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->section->name }}</td>
                                <td>{{ $service->provider->name }}</td>
                                <td>{{ $service->status }}</td>
                                <td> {{ $service->price }}</td>
                                <td>{{ $service->description }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm"
                                            data-service_name="{{ $service->name }}"
                                            data-service_id="{{ $service->id }}"
                                            data-section_name="{{ $service->section->name }}"
                                            data-description="{{ $service->description }}"
                                            data-price="{{ $service->price }}"
                                            data-service_image="{{ $service->image }}"
                                            data-toggle="modal"
                                            data-target="#edit_service">
                                            تعديل</button>

                                    <button class="btn btn-outline-danger btn-sm "
                                        data-service_id="{{ $service->id }}"
                                        data-service_name="{{ $service->name }}"
                                        data-toggle="modal"
                                        data-target="#modaldemo9">حذف</button>


                                    <a  class="btn btn-outline-success btn-sm "
                                        href="{{ url('user_details_service') }}/{{ $service->id }}">عرض
                                    </a>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>





    </div>
</div>


  <!-- The Modal  add -->
  <div  class="card-header" >
  <div class="container">
  <div class="modal fade" id="myModal" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <!-- Modal Header -->
        <div dir="rtl" class="modal-header text-right">
          <h4  class="modal-title">اضافة خدمة</h4>
          <button  type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{ route('userservices.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" >
            {{ csrf_field() }}
        <!-- Modal body -->
        <div  class="modal-body text-right">
            <div class="form-group">
                <label  for="exampleInputEmail1">اسم الخدمة</label>
                <input dir="rtl" type="text" class="form-control" id="name" name="name" required>
            </div>

            <label  class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
            <select name="section_id" id="section_id" class="form-control" required>
                <option value="" selected disabled> اختر القسم الذي تنتمي أليه خدمتك </option>
                @foreach ($sections2 as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
            <br>
            <div class="form-group">
                <label  for="exampleInputEmail1">أضف صورة تعبر عن الخدمة</label>
                <input type="file" class="form-control"  name="image" required>
              </div>


              <div class="form-group">
                <label for="exampleInputEmail1" >السعر المتوقع </label>
                <input type="number" class="form-control" id="price" name="price">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">وصف الخدمة </label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>



        </div>

        <!-- Modal footer -->
        <div dir="ltr" class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-primary">تاكيد</button>
        </div>
        </form>
      </div>
    </div>
        </div>
    </div>
  </div>
  <!-- end Modal add -->


  <!--  Modal edit -->
  <div class="card-header text-right" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="container">
    <div class="modal fade" id="edit_service">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

                <!-- model header  -->
                <div class="modal-header text-right">
                    <h5 class="modal-title">تعديل الخدمة</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action='userservices/update' method="post" autocomplete="off" enctype="multipart/form-data">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <!--model body -->
                    <div class="modal-body text-right">
                        <div class="form-group">
                            <label >اسم الخدمة</label>
                            <input type="hidden" class="form-control"  id="service_id" name="service_id" value="">

                            <input type="text" class="form-control" id="name" name="name" required>

                        </div>


                        <label  class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="" selected disabled> اختر القسم الذي تنتمي أليه خدمتك </option>
                            @foreach ($sections2 as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>


                        <div class="form-group">
                            <label  for="exampleInputEmail1">أضف صورة تعبر عن الخدمة </label>
                            <input type="file" class="form-control"  name="image" required>
                          </div>


                        <div dir="rtl" class="form-group">
                            <label>السعر المتوقع </label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>


                        <div dir="rtl" class="form-group">
                            <label for="exampleFormControlTextarea1">وصف الخدمة </label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div dir="ltr" class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal edit -->



     <!-- Modal delete -->

     <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف الخدمة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="userservices/destroy" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                    <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="service_id" id="service_id" value="">
                        <input class="form-control" name="service_name" id="service_name" type="text" readonly>
                    </div>
                    <div dir="ltr" class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </div>
            </form>
        </div>
    </div>
<!-- end Modal  delete -->
    <script>
        $('#edit_service').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var service_name = button.data('service_name')
            var section_name = button.data('section_name')
            var service_id = button.data('service_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #service_id').val(service_id);
            modal.find('.modal-body #service_name').val(service_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
         $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var service_name = button.data('service_name')
            var service_id = button.data('service_id')
            var modal = $(this)
            modal.find('.modal-body #service_id').val(service_id);
            modal.find('.modal-body #service_name').val(service_name);
        })
    </script>
@endsection


