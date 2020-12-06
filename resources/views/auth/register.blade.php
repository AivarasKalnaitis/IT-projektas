@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registracija') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="first_name" class="col-form-label text-md-right">{{ __('Vardas') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="col-form-label text-md-right">{{ __('Pavardė') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="car_number" class="col-form-label text-md-right">{{ __('Mašinos numeriai') }}</label>

                                    <input id="text" type="car_number" class="form-control @error('car_number') is-invalid @enderror" name="car_number" value="{{ old('car_number') }}"  autocomplete="car_number">

                                    @error('car_number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="power" class="col-form-label text-md-right">{{ __('Galia iki (kW):') }}</label>

                                    <select class="form-control @error('power') is-invalid @enderror" name="power">
                                        <option value="0" selected disabled>Pasirinkite mašinos galią:</option>
                                        <option value="60" {{ old("power") == "60" ? "selected" : ""}}>60</option>
                                        <option value="120" {{ old("power") == "120" ? "selected" : ""}}>120</option>
                                        <option value="200" {{ old("power") == "200" ? "selected" : ""}}>200</option>
                                    </select>

                                    @error('power')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="first_registration_country" class="col-form-label text-md-right">{{ __('Pirminė registracijos šalis') }}</label>

                                <input id="text" type="first_registration_country" class="form-control @error('first_registration_country') is-invalid @enderror" name="first_registration_country" value="{{ old('first_registration_country') }}" autocomplete="first_registration_country">

                                @error('first_registration_country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="engine" class="col-form-label text-md-right">{{ __('Variklio tūris iki (litrais):') }}</label>

                                    <select class="form-control @error('engine') is-invalid @enderror" name="engine">
                                        <option value="0" selected disabled>Pasirinkite variklio tūrį:</option>
                                        <option value="1.2" {{ old("engine") == "1.2" ? "selected" : ""}}>1.2</option>
                                        <option value="1.6" {{ old("engine") == "1.6" ? "selected" : ""}}>1.6</option>
                                        <option value="2.0" {{ old("engine") == "2.0" ? "selected" : ""}}>2.0</option>
                                        <option value="3.0" {{ old("engine") == "3.0" ? "selected" : ""}}>3.0</option>
                                    </select>

                                    @error('engine')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="insurance_events_count" class="col-form-label text-md-right">{{ __('Draudiminių įvykių skaičius') }}</label>

                                <input id="number" type="insurance_events_count" class="form-control @error('insurance_events_count') is-invalid @enderror" name="insurance_events_count" value="{{ old('insurance_events_count') }}" autocomplete="insurance_events_count">

                                @error('insurance_events_count')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Pašto Adresas') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="password" class="col-form-label text-md-right">{{ __('Slaptažodis') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="password_confirmation" class="col-form-label text-md-right">{{ __('Patvritinti slaptažodį') }}</label>
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registruotis') }}
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
