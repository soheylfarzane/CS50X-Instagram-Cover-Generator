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
                        <form method="POST" action="{{ route('storeTemplate') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="thumbnail"
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

                            <div class="col-6 float-end">
                                <div class="row mb-3 ">
                                    <label for="name" class="col-form-label text-md-end iran">{{ __('عنوان را وارد کنید') }}</label>
                                    <div class="col-md-12">
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
                            </div>
                            <div class="col-6 float-end">
                            <div class="row mb-3">
                                <label for="key" class="col-form-label text-md-end iran">{{ __('کلید برنامه نویسی') }}</label>

                                <div class="col-md-12">
                                    <select id="key"
                                            class="form-control iran @error('key') is-invalid @enderror"
                                            name="key">
                                        @foreach($keys as $index => $key)

                                            <option
                                                @foreach($templates as $template)
                                                @if($template->slug == $key)
                                                disabled
                                                @endif
                                                @endforeach



                                                value="{{$key}}">{{$index}}</option>
                                        @endforeach
                                    </select>


                                    @error('key')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>

                            <div class="col-6 float-end">
                            <div class="row mb-3">
                                <label for="font_id"
                                       class=" col-form-label text-md-end iran">{{ __('فونت اصلی') }}</label>

                                <div class="col-md-12">
                                    <select id="font_id"
                                            class="form-control iran @error('font_id') is-invalid @enderror"
                                            name="font_id">
                                        @foreach($fonts as $font)
                                            <option value="{{$font->id}}">{{$font->name}}  {{$font->weight}}</option>
                                        @endforeach
                                    </select>

                                    @error('font_id')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="col-6 float-end">
                            <div class="row mb-3">
                                <label for="category_id"
                                       class="col-form-label text-md-end iran">{{ __('دسته بندی') }}</label>

                                <div class="col-md-12">
                                    <select id="category_id"
                                            class="form-control iran @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4 form-check form-switch float-start">
                                    <input class="form-check-input" type="checkbox" id="text1"  name="text1" value="1" checked>
                                    <label class="form-check-label iran" for="text1" style="padding: 0 50px 0 10px">متن اول </label>
                                </div>
                                <div class="col-4 form-check form-switch float-start">
                                    <input class="form-check-input" type="checkbox" id="text2"  name="text2" value="1">
                                    <label class="form-check-label iran" for="text2" style="padding: 0 50px 0 10px">متن دوم </label>
                                </div>
                                <div class="col-4 form-check form-switch float-start">
                                    <input class="form-check-input" type="checkbox" id="text3"  name="text3" value="1">
                                    <label class="form-check-label iran" for="text3" style="padding: 0 50px 0 10px">متن سوم </label>
                                </div>
                                <div class="col-4 form-check form-switch float-start mt-4">
                                    <input class="form-check-input" type="checkbox" id="text4"  name="text4" value="1">
                                    <label class="form-check-label iran" for="text4" style="padding: 0 50px 0 10px">متن چهارم </label>
                                </div>
                                <div class="col-4 form-check form-switch float-start mt-4" >
                                    <input class="form-check-input" type="checkbox" id="text5"  name="text5" value="1">
                                    <label class="form-check-label iran" for="text5" style="padding: 0 50px 0 10px">متن پنجم </label>
                                </div>
                                <div class="col-4 form-check form-switch float-start mt-4">
                                    <input class="form-check-input" type="checkbox" id="text6"  name="text6" value="1">
                                    <label class="form-check-label iran" for="text6" style="padding: 0 50px 0 10px">متن ششم </label>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-4 float-start">
                                    <label for="maxText1"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن اول') }}</label>
                                        <input id="maxText1" type="text"
                                               class="form-control @error('maxText1') is-invalid @enderror iran"
                                               name="maxText1" value="{{ old('maxText1') }}">
                                </div>
                                <div class="col-4 float-start">
                                    <label for="maxText2"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن دوم') }}</label>
                                    <input id="maxText2" type="text"
                                           class="form-control @error('maxText2') is-invalid @enderror iran"
                                           name="maxText2" value="{{ old('maxText2') }}">
                                </div>
                                <div class="col-4 float-start">
                                    <label for="maxText3"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن سوم') }}</label>
                                    <input id="maxText3" type="text"
                                           class="form-control @error('maxText3') is-invalid @enderror iran"
                                           name="maxText3" value="{{ old('maxText3') }}">
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-4 float-start">
                                    <label for="maxText4"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن چهارم') }}</label>
                                    <input id="maxText4" type="text"
                                           class="form-control @error('maxText4') is-invalid @enderror iran"
                                           name="maxText4" value="{{ old('maxText4') }}">
                                </div>
                                <div class="col-4 float-start">
                                    <label for="maxText5"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن پنچم') }}</label>
                                    <input id="maxText5" type="text"
                                           class="form-control @error('maxText5') is-invalid @enderror iran"
                                           name="maxText5" value="{{ old('maxText5') }}">
                                </div>
                                <div class="col-4 float-start">
                                    <label for="maxText6"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن ششم') }}</label>
                                    <input id="maxText6" type="text"
                                           class="form-control @error('maxText6') is-invalid @enderror iran"
                                           name="maxText6" value="{{ old('maxText6') }}">
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-6 form-check form-switch float-start" style="padding-top: 40px;">
                                    <label class="form-check-label iran" for="logo" style="padding: 0 10px 0 10px">امکان اضافه کردن لوگو </label>
                                    <input class="form-check-input" type="checkbox" id="logo"  name="logo" value="1">
                                </div>
                                <div class="col-2 form-check form-switch float-start" style="padding-top: 40px;">
                                    <label class="form-check-label iran" for="longText" style="padding: 0 10px 0 10px"> متن بلند </label>
                                    <input class="form-check-input" type="checkbox" id="longText"  name="longText" value="1">
                                </div>
                                <div class="col-4 float-start">
                                    <label for="maxLongText"
                                           class="col-form-label text-md-end iran">{{ __('محدودیت متن طولانی را وارد کنید') }}</label>
                                    <input id="maxLongText" type="text"
                                           class="form-control @error('maxLongText') is-invalid @enderror iran"
                                           name="maxLongText" value="{{ old('maxLongText') }}">
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
