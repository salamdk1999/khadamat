@extends('layouts.masternew')
@section('content')
<form method="POST" action="{{url('profile/'.Auth::user()->id)}}" enctype="multipart/form-data">
    {{method_field('PATCH')}}
    {{csrf_field()}}
    <div dir="rtl" class=" pt-5 mt-5">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar pt-3"
                                    style="margin: 0 0 1rem 0; padding-bottom: 1rem;  text-align: center;">
                                    <img src="{{ $user->avatar }}" alt="">
                                    <div class="file btn btn-sm btn-dark">
                                        <span class="btn-text font-weight-bold" style="color: white;">تغيير
                                            الصورة</span>
                                        <input class="@error('avatar') is-invalid @enderror" type="file"
                                            name="avatar" />
                                        @error('avatar')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <h5 class="user-name">{{$user -> name}}</h5>
                                <h6 class="user-email">{{$user -> email}}</h6>
                            </div>
                            <!-- end user profile -->
                            <div class="about">
                                <h5>نبذة عني</h5>
                                <p>{{$user -> bio}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                        @endif
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h5 class="mb-2 text-primary font-weight-bold text-right">تعديل الملف الشخصي</h5>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-right">
                                <div class=" form-group">
                                    <label for="fullName">
                                        <h6>الاسم</h6>
                                    </label>
                                    <input type=" text" class="form-control" id="fullName" placeholder="اكتب اسمك"
                                        name="name" value="{{$user -> name}}">
                                    @error(' name') <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-right">
                                <div class="form-group">
                                    <label for="eMail">
                                        <h6>البريدالالكتروني</h6>
                                    </label>
                                    <input type="email" class="form-control" id="eMail" name="email"
                                        placeholder="ادخل البريد الالكتروني الخاص بك" value="{{$user -> email}}">
                                    @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-6 col-sm-6 col-12 text-right">
                                <div class="form-group">
                                    <label for="phone">
                                        <h6>نبذة عنك</h6>
                                    </label>
                                    <textarea type="text" class="form-control" rows="7" maxlength="72" name="bio"
                                        placeholder="اكتب نبذة عنك">{{$user -> bio}}</textarea>
                                    @error('bio')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @role('provider')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-right">
                                <div class="form-group">
                                    <label for="github" class="d-inline">
                                        <i class=" fab fa-github fa-2x d-inline"></i>
                                        <h6 class="d-inline mr-2">Github</h6>
                                    </label>
                                    <div class="">
                                        <input type="email" class="form-control mr-2 mt-2" id="github" name="socialite"
                                            placeholder="اكتب عنوان Github الخاص بك" style="display: inline;"
                                            value="{{$user -> socialite}}">
                                        @error('socialite')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endrole
                            <div class="row gutters pt-4 mr-1">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <input type="submit" class="btn btn-primary btn-sm" value="حفظ التغييرات">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

</div>
</div>


@endsection
