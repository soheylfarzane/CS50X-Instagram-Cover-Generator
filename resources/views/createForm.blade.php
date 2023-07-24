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

                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <img src="/{{$template->thumbnail}}" class="img-fluid">
                                </div>
                            </div>
                        </div>


                            <p>

                            </p>
                        <form method="POST" action="{{ route('generator',$template->slug) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end float-start iran">{{ __('فایل پس زمینه را انتخاب کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror iran" name="image"
                                           value="{{ old('image') }}">

                                    @error('image')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <label for="headding1"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('عنوان را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="headding1" type="text"
                                           class="form-control @error('headding1') is-invalid @enderror iran"
                                           name="headding1" value="{{ old('headding1') }}">

                                    @error('headding1')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="headding1Font"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('فونت عنوان را انتخاب کنید') }}</label>

                                <div class="col-md-6">
                                    <select id="headding1Font"
                                            class="form-control iran @error('headding1Font') is-invalid @enderror"
                                            name="headding1Font">
                                        @foreach($fonts as $font)
                                            <option value="{{$font->id}} ">{{$font->name}}  {{$font->weight}}</option>
                                        @endforeach
                                    </select>

                                    @error('headding1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="headding2"
                                       class="col-md-4 col-form-label text-md-end iran">{{ __('زیر عنوان را وارد کنید') }}</label>

                                <div class="col-md-6">
                                    <input id="headding2" type="text"
                                           class="form-control iran @error('headding2') is-invalid @enderror"
                                           name="headding2" value="{{ old('headding2') }}">

                                    @error('headding2')
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
                                    <select id="headding2Font"
                                            class="form-control iran @error('headding2Font') is-invalid @enderror"
                                            name="headding2Font">
                                        @foreach($fonts as $font)
                                            <option value="{{$font->id}}">{{$font->name}}  {{$font->weight}}</option>
                                        @endforeach
                                    </select>

                                    @error('headding2Font')
                                    <span class="invalid-feedback iran" role="alert">
                                        <strong class="iran">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="mt-3 iran" id="countdownTimer" style="display: none;">
                                            <span id="countdown"></span> ثانیه در حال ساخت کاور...

                                            <br>
                                            <br>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="container mb-0">
                                <div class="iran">
                                    <button type="submit" id="startButton" class="btn btn-primary col-12">
                                        {{ __('بساز') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to start the countdown timer
        function startCountdownTimer() {
            let seconds = 10;

            // Hide the submit button
            $('#submitButton').hide();

            // Show the countdown timer
            $('#countdownTimer').show();

            // Display the initial countdown value
            $('#countdown').text(seconds);

            // Start the countdown
            const countdownInterval = setInterval(() => {
                seconds--;
                $('#countdown').text(seconds);

                // When the countdown reaches 0, stop the interval and show the submit button
                if (seconds === 0) {
                    clearInterval(countdownInterval);
                    $('#countdownTimer').hide();
                    $('#submitButton').show();
                }
            }, 1000);
        }

        // When the "Start Countdown" button is clicked, trigger the countdown timer
        $('#startButton').on('click', startCountdownTimer);
    </script>
@endsection
