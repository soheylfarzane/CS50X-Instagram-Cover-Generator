@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('تنظیمات') }}</div>

                    <div class="card-body">
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


                        <form method="POST" action="{{ route('storeSetting') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('فایل لوگو را انتخاب کنید') }}</label>
                                <div class="col-md-6">
                                    <input id="logo" type="file"
                                           class="form-control @error('logo') is-invalid @enderror iran" name="logo"
                                           value="{{ old('logo') }}">

                                    @error('logo')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-4"></div>
                                <div class="col-4">
                                    <img src="{{$setting->logo}}" class="img-fluid m-3">
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('عنوان نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror iran"
                                           name="name" value="{{$setting->name}}">

                                    @error('name')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('بنر اول نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="banner1" type="file"
                                           class="form-control @error('banner1') is-invalid @enderror iran" name="banner1"
                                           value="{{ old('banner1') }}">

                                    @error('banner1')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-3"></div>
                                <div class="col-6">
                                <img src="{{$setting->banner1}}" class="img-fluid m-3">
                                </div>
                                <div class="col-3"></div>

                            </div>
                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('بنر دوم نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="banner2" type="file"
                                           class="form-control @error('banner2') is-invalid @enderror iran" name="banner2"
                                           value="{{ old('banner2') }}">

                                    @error('banner2')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <img src="{{$setting->banner2}}" class="img-fluid m-3">
                                </div>
                                <div class="col-3"></div>

                            </div>
                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('بنر سوم نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="banner3" type="file"
                                           class="form-control @error('banner3') is-invalid @enderror iran" name="banner3"
                                           value="{{ old('banner3') }}">

                                    @error('banner3')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <img src="{{$setting->banner3}}" class="img-fluid m-3">
                                </div>
                                <div class="col-3"></div>

                            </div>
                            <div class="row mb-3">
                                <label for="slogan"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('شعار نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="slogan" type="text"
                                           class="form-control @error('slogan') is-invalid @enderror iran"
                                           name="slogan" value="{{$setting->slogan}}">

                                    @error('slogan')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('توضیحات نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text"
                                           class="form-control @error('description') is-invalid @enderror iran"
                                           name="description" value="{{$setting->description}}">

                                    @error('description')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="message"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('پیام نرم افزار را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="message" type="text"
                                           class="form-control @error('message') is-invalid @enderror iran"
                                           name="message" value="{{$setting->message}}">

                                    @error('message')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="aboutUrl"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('آدرس درباره ما را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="aboutUrl" type="text"
                                           class="form-control @error('aboutUrl') is-invalid @enderror iran"
                                           name="aboutUrl" value="{{$setting->aboutUrl}}">

                                    @error('aboutUrl')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="siteUrl"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('آدرس سایت را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="siteUrl" type="text"
                                           class="form-control @error('siteUrl') is-invalid @enderror iran"
                                           name="siteUrl" value="{{$setting->siteUrl}}">

                                    @error('siteUrl')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('تاریخ آخرین آپدیت') }}</label>

                                <div class="col-md-6">
                                    <input id="lastUpdate" type="text"
                                           class="form-control @error('lastUpdate') is-invalid @enderror iran"
                                           name="lastUpdate" value="{{$setting->lastUpdate}}">

                                    @error('lastUpdate')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="updatedUrl"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('آدرس دانلود را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="updatedUrl" type="text"
                                           class="form-control @error('updatedUrl') is-invalid @enderror iran"
                                           name="updatedUrl" value="{{$setting->updatedUrl}}">

                                    @error('updatedUrl')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="version"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('ورژن نرم افزار') }}</label>

                                <div class="col-md-6">
                                    <select id="version" type="text"
                                            class="form-control @error('version') is-invalid @enderror iran"
                                            name="version" >
                                        @for($i = 1; $i <= 9 ; $i++)
                                            @for($j = 0; $j <= 9 ; $j++)
                                                @for($k = 0; $k <= 9 ; $k++)
                                                    <option
                                                        @if($setting->version == $i.'.'.$j.'.'.$k)
                                                        SELECTED
                                                        @endif

                                                        value="{{$i.'.'.$j.'.'.$k}}">{{$i.'.'.$j.'.'.$k}}</option>
                                                @endfor
                                            @endfor
                                        @endfor


                                    </select>

                                    @error('weight')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="container mb-0">
                                <div class="iran">
                                    <button type="submit" id="startButton" class="btn btn-primary col-12">
                                        {{ __('ذخیره') }}
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
