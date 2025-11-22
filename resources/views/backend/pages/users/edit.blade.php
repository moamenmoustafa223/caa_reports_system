@extends('backend.layouts.master')

@section('page_title')
    {{ trans('users.edit_user') }}
@endsection


@section('content')
    <div class="col-sm-4">
        <a class="btn btn-primary btn-sm mb-1" href="{{ route('users.index') }}">
            <i class="fas fa-chevron-right me-1"></i>
            {{ trans('users.Back') }}
        </a>
    </div>

    <div class="row">
        <div class="col-md-12 ">
            <div class="card-box">


                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <!-- الاسم -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('users.name') }}</strong>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Name" class="form-control">
                            </div>
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('users.email') }}</strong>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Email" class="form-control">
                            </div>
                        </div>

                        <!-- كلمة المرور -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('users.password') }}</strong>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('users.Confirm_Password') }}</strong>
                                <input type="password" name="confirm-password" placeholder="Confirm Password"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- الحالة -->
                        <div class="col-md-6">
                            <label for="status">{{ trans('back.Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>
                                    {{ trans('back.active') }}</option>
                                <option value="2" {{ old('status', $user->status) == 2 ? 'selected' : '' }}>
                                    {{ trans('back.inactive') }}</option>
                            </select>
                        </div>

                        <!-- الأدوار -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('users.Roles') }}</strong>
                                <select name="roles[]" class="form-control">
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ in_array($key, old('roles', $userRole)) ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- زر الحفظ -->
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-success">{{ trans('users.Save') }}</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div> <!-- end row -->
@endsection
