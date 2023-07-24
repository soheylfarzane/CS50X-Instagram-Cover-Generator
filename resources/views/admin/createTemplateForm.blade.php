@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('تولید عکس و استوری') }}</div>

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

                            <p>

                            </p>
                        <form method="POST" action="{{ route('generator') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('نمونه فایل را انتخاب کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="thumbnail" type="file"
                                           class="form-control @error('image') is-invalid @enderror iran" name="thumbnail"
                                           value="{{ old('thumbnail') }}">

                                    @error('thumbnail')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('عنوان را وارد کنید') }}</label>

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
                                <label for="key"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('کلید برنامه نویسی') }}</label>

                                <div class="col-md-6">
                                    <input id="key"
                                            class="form-control iran @error('key') is-invalid @enderror"
                                            name="key">


                                    @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="font"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('فونت اصلی') }}</label>

                                <div class="col-md-6">
                                    <input id="font" type="text"
                                           class="form-control iran @error('font') is-invalid @enderror"
                                           name="font" value="{{ old('font') }}">

                                    @error('font')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="headding2Font"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('فونت زیر عنوان را انتخاب کنید') }}</label>

                                <div class="col-md-6">
                                    <select id="font"
                                            class="form-control iran @error('font') is-invalid @enderror"
                                            name="font">
                                        @foreach($fonts as $font)
                                            <option value="{{$font->id}}">{{$font->name}}  {{$font->weight}}</option>
                                        @endforeach
                                    </select>

                                    @error('font')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="headding2Font"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('دسته بندی') }}</label>

                                <div class="col-md-6">
                                    <select id="category"
                                            class="form-control iran @error('font') is-invalid @enderror"
                                            name="category">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
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


@endsection
