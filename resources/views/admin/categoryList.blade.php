@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">
                        <p class="float-end">{{ __('دسته بندی قالب ها') }}</p>
                        <a class="btn btn-success float-start" type="submit" href="{{route('addCategory')}}">افزودن دسته
                            بندی جدید</a>
                    </div>

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
                        <ul class="list-group iran" style="padding: 0; margin: 0 !important;">

                            @foreach($categories as $category)
                                <div class="row">
                                    <a class="btn btn-success col-7 float-start iran m-1" href="">
                                        {{$category->name}}
                                    </a>
                                    <a class="btn btn-primary col-2 float-start iran m-1" type="button">
                                        ویرایش
                                    </a>
                                    <form class="col-2  float-start iran m-1" action="{{route('deleteCategory',$category->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger " type="submit">
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
