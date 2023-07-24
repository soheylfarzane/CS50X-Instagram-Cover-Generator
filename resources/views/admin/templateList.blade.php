@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('قالب ها') }}</div>

                    <div class="card-body">

                        <div class="container">

                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="/template/cover.png" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text class="iran" style="padding: 10px" x="50%" y="50%" fill="#eceeef" dy=".3em">کاور دکتر کاویانی</text></img>
                                        <div class="card-body">
                                             <div class="d-flex justify-content-between align-items-center iran">

                                                    <button type="button" class="btn btn-sm btn-primary iran">ساخت کاور</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary iran">ویرایش</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
