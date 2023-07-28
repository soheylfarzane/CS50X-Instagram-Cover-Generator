@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('داشبورد') }}</div>

                    <div class="card-body">

<h2 class="iran">تا الان {{$countUsers}} کاربر عضو شده.</h2>
                        <br>
                        <h2 class="iran">تا الان {{$countResults}} فایل طراحی شده.</h2>
                        <br>
                        <h2 class="iran">تا الان {{$countTemplates}} قالب اضافه شده.</h2>
                        <br>
                        <h2 class="iran">تا الان {{$countFonts}} فونت اضافه شده.</h2>
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
