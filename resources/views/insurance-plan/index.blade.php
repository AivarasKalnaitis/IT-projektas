@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Draudimo polisų sąrašas</h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('insurance-plans.create') }}" class="btn btn-success" role="button">Pridėti naują</a>
                @endif
            @endauth
        </div>
        <hr>
        @include('success')
        @include('errors')

        @guest
            <div class="row">
                <div class="col-5">
                    <form class="form-inline d-flex justify-content-between align-items-center">

                        <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name"
                               placeholder="Plano pavadinimas" value="{{ request()->input('name') }}"
                        >

                        <input type="number" class="form-control mb-2 mr-sm-2" id="years_of_experience" name="years_of_experience"
                               placeholder="Varavimo stažas" value="{{ request()->input('years_of_experience') }}"
                        >

                        <button type="submit" class="btn btn-success btn-block mb-2" name="action" value="filterList">Filtruoti sąrašą</button>
                    </form>
                </div>
                <div class="col">
                    <form class="form-inline d-flex justify-content-between align-items-center">
                        <select required="required" class="form-control mb-2 mr-sm-2" id="power" name="power">
                            <option value="" selected disabled>--Mašinos galia--</option>
                            <option value="60" {{ old('power') == 60 ? 'selected' : '' }}>60</option>
                            <option value="120"  {{ old('power') == 120 ? 'selected' : '' }}>120</option>
                            <option value="200" {{ old('power') == 200 ? 'selected' : '' }}>200</option>
                        </select>
                        <select required="required" class="form-control mb-2 mr-sm-2" id="engine" name="engine">
                            <option value="" selected disabled>--Variklio tūris--</option>
                            <option value="1.2" {{ old('engine') == 1.2 ? 'selected' : '' }}>1.2</option>
                            <option value="1.6" {{ old('engine') == 1.6 ? 'selected' : '' }}>1.6</option>
                            <option value="2.0" {{ old('engine') == 2.0 ? 'selected' : '' }}>2.0</option>
                            <option value="3.0" {{ old('engine') == 3.0 ? 'selected' : '' }}>3.0</option>
                        </select>

                        <input type="number" required class="form-control mb-2 mr-sm-2" id="insurance_events_count" name="insurance_events_count"
                               placeholder="Įvykių skaičius" value="{{ request()->input('insurance_events_count') }}"
                        >

                        <button type="submit" class="btn btn-block btn-info text-white mb-2 mr-sm-2" name="action" value="calculatePrice">Skaičiuoti kainą</button>
                    </form>
                </div>
            </div>
        @endguest

        <ul class="list-group">
            @foreach($insurancePlans as $plan)
                    <li class="list-group-item list-group-item flex-column align-items-start mt-2">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-capitalize font-weight-bold">{{ $plan->name }}</h5>
                            <small>
                                {{ $plan->updated_at }}
                            </small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <p class="mb-1"> <b>Draudimo laikotarpis (mėnesiais): </b> {{ $plan->months_count }} </p>
                                <small> <b> Patirtis metais: </b>{{  $plan->years_of_experience }}</small>
                                @auth
                                    @if(auth()->user()->isSimpleUser())
                                       <small> <b> Kaina: </b> {{ auth()->user()->calculatePrice($plan->id) }} € /mėn</small>
                                       @if(false !== $plan->discount)
                                            <br>
                                            <small> <b class="text-success"> Nuolaida: </b> {{ auth()->user()->applyDiscount($plan->id) }} € /mėn</small>
                                            <br>
                                            <small> <b class="text-info">Kaina su nuolaida: </b> {{ auth()->user()->calculatePrice($plan->id) -  auth()->user()->applyDiscount($plan->id) }}  € /mėn </small>
                                        @endif
                                    @endif
                                @endauth
                                @guest
                                @inject('planModel', 'App\User')
                                    <small> <b> Kaina: </b> {{ null !== request()->input('insurance_events_count') ? $planModel->CalculatePriceGuest(request()->input('insurance_events_count'), request()->input('power'), request()->input('engine'), $plan->id) : '-' }} € /mėn</small>
                                @endguest
                            </div>
                            <div>
                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <a class="btn btn-outline-primary" href="{{ route('insurance-plans.edit', $plan) }}" role="button">Redaguoti</a>
                                        <form action="{{ route('insurance-plans.destroy', $plan->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    @elseif (auth()->user()->isManager())
                                        <a class="btn btn-outline-dark" href="{{ route('insurance-plans.show', $plan->id) }}">Peržiūrėti draudimo planą</a>
                                    @elseif (!auth()->user()->hasOrderedPlan())
                                        <a class="btn btn-outline-primary" href="{{ route('insurance-plans.show', $plan->id) }}">Užsakyti draudimo planą</a>
                                    @elseif (auth()->user()->canRejectPlan($plan->id))
                                        <a class="btn btn-outline-danger" href="{{ route('insurances.destroy', 0) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();"
                                        > Atsisakyti plano</a>
                                        <form id="delete-form" action="{{ route('insurances.destroy', auth()->user()->insurances()->first()->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    @elseif (auth()->user()->canExtendPlan($plan->id))
                                        <span class="mr-4 text-secondary font-italic">
                                        Galioja iki: {{ auth()->user()->getHowLongPlanIsVallid($plan->id) }}
                                        </span>
                                        <a class="btn btn-outline-success" href="{{ route('insurance-plans.extend', $plan->id) }}">Pratęsti</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </li>
            @endforeach
        </ul>

        <div class="paginator-container mt-4">
            {{ $insurancePlans->links() }}
        </div>
    </div>
@endsection

