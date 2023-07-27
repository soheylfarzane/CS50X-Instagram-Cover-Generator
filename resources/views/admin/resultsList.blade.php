@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">
                        <p class="float-end">{{ __('آخرین طراحی های کاربران') }}</p>

                    </div>

                    <div class="card-body">

                        <div class="container">

                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                                @foreach($results as $result)
                                    @if($result->path == '#')
                                    @else
                                        <div class="col">
                                            <div class="card shadow-sm">
                                                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{$result->path}}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                                                <rect width="100%" height="100%" fill="#55595c"></rect>
                                                </img>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center iran">

                                                        <a href="{{$result->path}}" class="btn btn-sm btn-primary  m1 iran">مشاهده تصویر با کیفیت</a>
{{--                                                        <button type="button" class="btn btn-sm btn-outline-secondary iran">ویرایش</button>--}}
                                                        <form class="float-start iran m-1" action="{{route('resultsDelete',$result->id)}}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-outline-danger" type="submit">
                                                                حذف
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
