@extends('layouts.app')

@section('content')
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="card d-flex justify-content-center flex-column align-items-center">
                <div id="ad-my-inside-container">
                <img src="{{asset('assets/img/sapilogo/sapilogo.png')}}" alt="" style="max-width:80px; margin: 0 auto;" class="d-flex text-center">
                <div class="text-center"><span id="ad-login-span1"> Adminisztrátor</span><br> <span id="ad-login-span2">Gazdasági informatika</span></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" style="margin-right: 50px; width: 100%">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input id="password" placeholder="Jelszó" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" id="ad-btn" class="btn btn-primary " style="width: 100%;">
                                    Bejelentkezés
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                    </div>
            </div>
        </div>
@endsection
