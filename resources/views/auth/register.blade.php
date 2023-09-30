@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

                            </div>
                        </div>
                        <div class="col-md-8 pl-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Article <span>Management System</span></a>
                                <h5 class="text-muted font-weight-normal mb-4">{{__('common.register_welcome_message')}}</h5>
                                <form class="forms-sample" action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name" class="col-md-6 col-form-label text-md-right">{{ __('common.name') }}</label>

                                        <div class="col-md-12">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-md-6 col-form-label text-md-right">{{ __('common.email') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-md-6 col-form-label text-md-right">{{ __('common.password') }}</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-6 col-form-label text-md-right">{{ __('common.confirm_password') }}</label>

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar" class="col-md-6 col-form-label text-md-right">{{ __('common.avatar') }}</label>

                                        <div class="col-md-12">
                                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" required>

                                            @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="col-md-12 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('common.register') }}
                                            </button>
                                        </div>
                                    </div>

                                    <p class="mt-3">
                                        <span>{{__('common.have_account')}}</span>
                                        <a href="{{ url(route('login')) }}" class="mt-3 text-muted">{{__('common.login_now')}}</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
