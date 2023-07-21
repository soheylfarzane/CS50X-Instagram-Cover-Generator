@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تولید عکس و استوری') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                        <form method="POST" action="{{ route('generator') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('فایل پس زمینه را انتخاب کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required  autofocus>

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="headding1" class="col-md-4 col-form-label text-md-end">{{ __('عنوان را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="headding1" type="text" class="form-control @error('headding1') is-invalid @enderror" name="headding1" value="{{ old('headding1') }}" required  autofocus>

                                    @error('headding1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="headding2" class="col-md-4 col-form-label text-md-end">{{ __('زیر عنوان را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="headding2" type="text" class="form-control @error('headding2') is-invalid @enderror" name="headding2" >

                                    @error('headding2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('بساز') }}
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
