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
                                <h5 class="text-muted font-weight-normal mb-4">{{__('common.login_welcome_message')}}</h5>
                                <form class="forms-sample" action="{{route('login')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">{{__('common.email')}}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{__('common.email')}}">

                                        @error('email')
                                        <span class="invalid-feedback block d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{__('common.password')}}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="current-password" placeholder="{{__('common.password')}}">
                                        @error('password')
                                        <span class="invalid-feedback block d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        {{--<label class="form-check-label">--}}
                                            {{--<input type="checkbox" class="form-check-input" name="remember">--}}
                                            {{--{{__('common.remember_me')}}--}}
                                        {{--</label>--}}
                                    </div>
                                    <div class="mt-3">
                                        <input type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0" value="{{__('common.login')}}" />
                                    </div>
                                    <p class="mt-3">
                                        <span>{{__('common.have_no_account')}}</span>
                                        <a href="{{ url(route('register')) }}" class="mt-3 text-muted">{{__('common.register_now')}}</a>
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