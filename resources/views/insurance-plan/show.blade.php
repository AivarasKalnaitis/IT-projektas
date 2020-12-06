@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Draudimo poliso informacija</h1>
        <hr>
        @include('errors')

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-capitalize" scope="col">Draudiminiai įvikiai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th class="text-capitalize" scope="row"> {{ $event->event }}</th>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th class="text-capitalize" scope="col">Parametras</th>
                <th class="text-capitalize" scope="col">Reikšmė (iki)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parameters as $parameter)

                <tr>
                    <th class="text-capitalize" scope="row"> {{ $parameter->parameter }}</th>
                    <td>
                        {{ $parameter->value }}
                        @if($parameter->parameter === 'Svoris') kg
                        @elseif($parameter->parameter === 'Galia') kw
                        @elseif($parameter->parameter === 'Variklio tūris') l
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @auth()
            @if (!auth()->user()->isManager())
                <div class="d-flex justify-content-end">
                    @if(false !== $insurance->discount)
                        <h3 class="font-weight-bold mr-3">Kaina:</h3>  <h3> {{ auth()->user()->calculatePrice($insurance->id) -  auth()->user()->applyDiscount($insurance->id) }} € </h3>
                    @else
                        <h3 class="font-weight-bold mr-3">Kaina</h3>  <h3> {{ auth()->user()->calculatePrice($insurance->id) }} € </h3>
                    @endif
                </div>

                <form action="{{ route('insurances.store', $insurance->id) }}" method="post">
                    @csrf
                    <input class="d-none" name="insurance" value="{{$insurance->id}}">
                    <input class="d-none" name="price" value="{{ auth()->user()->calculatePrice($insurance->id) }}">
                    <button type="submit" class="btn btn-primary btn-block">Užsakyti</button>
                </form>
            @endif
        @endauth
    </div>
@endsection


