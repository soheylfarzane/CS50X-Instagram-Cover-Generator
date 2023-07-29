@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('ورود به سامانه') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('fail'))
                            <div class="alert alert-danger iran" role="alert">
                                {{ session('fail') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end iran">{{ __('شماره موبایل') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $phone }}"  DISABLED>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end iran">{{ __('کد تایید') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4 iran">
                                    <button type="submit" class="btn btn-primary iran">
                                        {{ __('ورود به پنل کاربری') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
