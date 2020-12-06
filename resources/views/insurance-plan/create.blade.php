@extends('layouts.app')

@section('title','Pidėti draudimo planą')

@section('content')

    <div class="container">
        <h1>Draudimo poliso kūrimas</h1>
        <hr>
        @include('errors')
        <div class="row">
            <div class="col">
                <form action="{{ route('insurance-plans.store') }}" method="post">
                    @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Pavadinimas</label>
                                    <input type="text" class="form-control" name="name" id="name"  value="{{ old('name') }}" placeholder="Pavadinimas">
                                </div>
        
                                <div class="form-group col-md-6">
                                    <label for="years_of_experience">Reikalingas vairavimo stažas (metais)</label>
                                    <input type="text" class="form-control"  name="years_of_experience" id="years_of_experience"  value="{{ old('years_of_experience') }}" placeholder="Stažas">
                                </div>
                            </div>
        
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="months_count">Laikotarpis (mėnesiais)</label>
                                        <select class="form-control" id="months_count" name="months_count">
                                            <option value="3" selected>3</option>
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-row ml-1 d-flex justify-content-between">
                                <div class="form-group">
                                    <h4>Draudiminiai įvikiai</h4>
                                    @foreach($events as $event)
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="events[]" type="checkbox" value="{{$event->id}}"
                                            {{ (is_array(old('events')) && in_array($event->id, old('events'))) ? ' checked' : '' }}
                                            id="e-{{$event->id}}">
                                            <label class="custom-control-label" for="e-{{$event->id}}">
                                                {{$event->event}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
        
                                <div class="form-group col-3">
                                    <h4>Parametrai</h4>
                                    <label for="power">Automobilio galia</label>
                                    <select required="required" class="form-control mb-2 mr-sm-2" id="power" name="power">
                                        <option value="60"  {{ old("power") == "60" ? "selected" : ""}}>60</option>
                                        <option value="120" {{ old("power") == "120" ? "selected" : ""}}>120</option>
                                        <option value="200" {{ old("power") == "200" ? "selected" : ""}}>200</option>
                                    </select>
                                    <label for="engine">Automobilio variklio tūris</label>
                                    <select required="required" class="form-control mb-2 mr-sm-2" id="engine" name="engine">
                                        <option value="1.2" {{ old("engine") == "1.2" ? "selected" : ""}}>1.2</option>
                                        <option value="1.6" {{ old("engine") == "1.6" ? "selected" : ""}}>1.6</option>
                                        <option value="2.0" {{ old("engine") == "2.0" ? "selected" : ""}}>2.0</option>
                                        <option value="3.0" {{ old("engine") == "3.0" ? "selected" : ""}}>3.0</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-3 ml-7">
                                    <h4>Pritaikyti nuolaidą?</h4>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="discount" name="discount">
                                        <label class="custom-control-label" for="discount"></label>
                                    </div>
                                </div>
                            </div>
        
                    <button type="submit" class="btn btn-primary btn-block">Pridėti</button>
                </form>
            </div>
            <div class="col border-left">
                <h4>Draudimo poliso šablono supildymas</h4>
                {{-- 60kW   1.2 ir 1.6 l --}}
                <div class="row ml-1">
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>60 kW,</b>
                                    <b>1.2 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>60 kW,</b>
                                    <b>1.2 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>60 kW,</b>
                                    <b>1.6 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                {{-- 120kW  2 l --}}
                <div class="row ml-1 d-flex ">
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>60 kW,</b>
                                    <b>1.6 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>120 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>120 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>   
                </div>
                <div class="row ml-1">
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                    <i class="fas fa-screwdriver"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>120 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>200 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>200 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                    <i class="fas fa-screwdriver"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>200 kW,</b>
                                    <b>2.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                    <i class="fas fa-screwdriver"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>200 kW,</b>
                                    <b>3.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="col-4 my-1">
                        <button class="btn btn-success">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-car-crash"></i>
                                    <i class="fas fa-fire"></i>
                                    <i class="fas fa-mask"></i>
                                    <i class="fas fa-water"></i>
                                    <i class="fas fa-screwdriver"></i>
                                    <i class="fas fa-bomb"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <b>200 kW,</b>
                                    <b>3.0 l</b>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                    
                    
        
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
