@extends('layouts.appNoMenu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card iran">
                <div class="card-header iran">{{ __('دانلود فایل') }}</div>

                <div class="card-body iran">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <img class="img-fluid" src="/{{$path}}">

                    <a href="{{$path}}" class="btn btn-primary col-6 iran float-start" style="margin-top: 25px">دریافت فایل</a>
                    <a href="/" class="btn btn-outline-primary col-6 iran float-start" style="margin-top: 25px">برگرد صفحه اصلی</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
