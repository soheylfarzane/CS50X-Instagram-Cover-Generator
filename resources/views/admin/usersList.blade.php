@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header iran">{{ __('لیست کاربران') }}</div>

                    <div class="card-body iran">

                        <ul class="list-group iran" style="padding: 0; margin: 0 !important;">

                            @foreach($users as $user)
                                <div class="container-fluid mb-2">
                                    <a class="btn btn-danger iran" style="width: 35%" href="">
                                       {{$user->name}}
                                    </a>
                                    <a class="btn btn-primary collapsed iran" type="button" style="width:60%;">
                                        جزئیات بیشتر
                                    </a>
                                </div>
                            @endforeach
                        </ul>

                    </div>
                    <div style="align-content: center;align-items: center">
                        {{ $users->onEachSide(0)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
