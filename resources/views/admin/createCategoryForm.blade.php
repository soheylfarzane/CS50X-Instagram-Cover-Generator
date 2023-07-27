@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('دسته بندی قالب ها') }}</div>

                    <div class="card-body iran">
                        @if (session('status'))
                            <div class="alert alert-success iran" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('fail'))
                            <div class="alert alert-danger iran" role="alert">
                                {{ session('fail') }}
                            </div>
                        @endif

                            <div class="row">
                                <form method="POST" action="{{ route('storeCategory') }}" enctype="multipart/form-data">
                                    @csrf



                                    <div class="row mb-3">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-end iran">{{ __('عنوان') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror iran"
                                                   name="name" value="{{ old('name') }}">

                                            @error('name')
                                            <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-end iran">{{ __('عنوان انگلیسی') }}</label>

                                        <div class="col-md-6">
                                            <input id="slug" type="text"
                                                   class="form-control @error('slug') is-invalid @enderror iran"
                                                   name="slug" value="{{ old('slug') }}">

                                            @error('slug')
                                            <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>





                                    <div class="container mb-0">
                                        <div class="iran">
                                            <button type="submit" id="startButton" class="btn btn-primary col-12">
                                                {{ __('اضافه کردن') }}
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
