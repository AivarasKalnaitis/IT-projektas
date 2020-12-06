@extends('layouts.app')

@section('title','Atnaujinti draudimo planą')

@section('content')

    <div class="container">
        <h1>Draudimo poliso atnaujinimas</h1>
        <hr>
        @include('errors')
        <form action="{{ route('insurance-plans.update', $insurancePlan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Pavadinimas</label>
                    <input type="text" class="form-control" name="name"
                           id="name" placeholder="Pavadinimas" value="{{ $insurancePlan->name }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <label for="years_of_experience">Reikalingas vairavimo stažas (metais)</label>
                    <input type="text" class="form-control"  name="years_of_experience"
                           id="years_of_experience" placeholder="Stažas" value="{{ $insurancePlan->years_of_experience }}"

                    >
                </div>
            </div>
            <div class="form-group">
                <label for="months_count">Laikotarpis (mėnesiais)</label>
                <select class="form-control" id="months_count" name="months_count">
                    <option value="3" @if($insurancePlan->months_count == 3) echo selected @endif>3</option>
                    <option value="6" @if($insurancePlan->months_count == 6) echo selected @endif>6</option>
                    <option value="12" @if($insurancePlan->months_count == 12) echo selected @endif>12</option>
                </select>
            </div>
            <div class="form-row ml-1 d-flex justify-content-between">
                <div class="form-group col-6">
                    <h4>Draudiminiai įvykiai</h4>
                    @foreach($events as $event)
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="events[]" type="checkbox" value="{{$event->id}}" id="e-{{$event->id}}"
                                   @if(in_array($event->id,$selectedE->toArray())) echo checked @endif
                            >
                            <label class="custom-control-label" for="e-{{$event->id}}">
                                {{$event->event}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group col-2">
                    <h4>Parametrai</h4>
                    <div class="form-group">
                        <label for="months_count">Variklio galia</label>
                        <select class="form-control" id="power" name="power">
                            <option value="60" @if($power == 60) echo selected @endif>60</option>
                            <option value="120" @if($power == 120) echo selected @endif>120</option>
                            <option value="200" @if($power == 200) echo selected @endif>200</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="months_count">Variklio tūris</label>
                        <select class="form-control" id="engine" name="engine">
                            <option value="1.2" @if($engine == 1.2) echo selected @endif>1.2</option>
                            <option value="1.6" @if($engine == 1.6) echo selected @endif>1.6</option>
                            <option value="2.0" @if($engine == 2.0) echo selected @endif>2.0</option>
                            <option value="3.0" @if($engine == 3.0) echo selected @endif>3.0</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-3">
                    <h4>Pritaikyti nuolaidą?</h4>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input"id="discount" name="discount"
                            @if(false !== $insurancePlan->discount) echo checked @endif
                        >
                        <label class="custom-control-label" for="discount"></label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Atnaujinti</button>
        </form>
    </div>

@endsection
