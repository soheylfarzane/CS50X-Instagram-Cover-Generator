@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">
                        <p class="float-end">{{ __('فونت ها') }}</p>
                        <a class="btn btn-success float-start" type="submit" href="{{route('addFont')}}">افزودن فونت</a>
                    </div>

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
                        <ul class="list-group iran" style="padding: 0; margin: 0 !important;">

                            @foreach($fonts as $font)
                                <div class="row">
                                    <a class="btn btn-primary col-8 float-start iran m-1" href="">
                                        {{$font->name}}
                                        -
                                        {{$font->weight}}
                                    </a>
                                    <form class="col-2  float-start iran m-1" action="{{route('deleteFont',$font->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
