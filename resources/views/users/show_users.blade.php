@extends('layouts.master')
@section('css')

@section('title')
المستخدمين
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                المستخدمين</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة مستخدم</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive border-top userlist-table">
									<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
										<thead>
											<tr>
                                            <th class="wd-15p border-bottom-0"> </th>
											<th class="wd-15p border-bottom-0">اسم المستخدم</th>
											<th class="wd-20p border-bottom-0">البريد الالكتروني</th>
											<th class="wd-15p border-bottom-0">نوع المستخدم</th>
											<th class="wd-10p border-bottom-0">الإجراءات</th>

											</tr>
										</thead>
										<tbody>
										@foreach ($data as $key => $user)
											<tr>
												<td>
													<img alt="{{$user ->name}}" src="{{$user ->avatar}}" width="50" height="50" style="border-radius:100%;">
												</td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												<td>
													@if (!empty($user->getRoleNames()))
														@foreach ($user->getRoleNames() as $v)
															<label class="badge badge-success">{{ $v }}</label>
														@endforeach
													@endif
												</td>
												<td>
													<a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
														title="تعديل"><i class="las la-pen"></i></a>

													<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														data-user_id="{{ $user->id }}" data-username="{{ $user->name }}"
														data-toggle="modal" href="#modaldemo8" title="حذف"><i
															class="las la-trash"></i></a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<ul class="pagination mt-4 mb-0 float-left">
									<li class="page-item page-prev disabled">
										<a class="page-link" href="#" tabindex="-1">السابق</a>
									</li>
									<li class="page-item page-next">
										<a class="page-link" href="#">التالي</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- COL END -->
					<!-- Modal effects -->
						<div class="modal" id="modaldemo8">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
											data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<form action="{{ route('users.destroy', 'test') }}" method="post">
										{{ method_field('delete') }}
										{{ csrf_field() }}
										<div class="modal-body">
											<p>هل انت متاكد من عملية الحذف ؟</p><br>
											<input type="hidden" name="user_id" id="user_id" value="">
											<input class="form-control" name="username" id="username" type="text" readonly>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
											<button type="submit" class="btn btn-danger">تاكيد</button>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>

				</div>
				<!-- row closed  -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })

</script>


@endsection
