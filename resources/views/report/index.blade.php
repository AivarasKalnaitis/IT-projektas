@extends('layouts.app')

@section('title','Generate report')

@section('content')

    <div class="form-container">

        @include('errors')

        <h1 class="card-header bg-card-header text-center py-4">
            <strong>Generuoti ataskaita</strong>
        </h1>

        <form action="{{ route('reports.generate') }}" method="post">
            @csrf

            <div class="form-group-wide">
                <div class="form-entry">
                    <label for="date_from">Pradžios data</label>
                    <input type="date" class="form-control" name="date_from" id="date_from" value="{{ old('date_from') }}">
                </div>

                <div class="form-entry">
                    <label for="date_to">Pabaigos data</label>
                    <input type="date" class="form-control" name="date_to" id="date_to" value="{{ old('date_to') }}">
                </div>

                <div class="form-entry-left">
                    <label for="report-for">Atasakita skirta draudimo polisams kurie buvo:</label>
                    <select id="report-for" name="report">
                        <option value="ordered" selected>Užsakyti</option>
                        <option value="sold">Parduoti</option>
                    </select>
                </div>

                <div class="form-entry-left">
                    <label for="report-for-insurance">Ataskaita kuriama draudimo polisui kurio numeris:</label>
                    <select id="report-for-insurance" name="insurance">
                        <option value="0">Visiem</option>
                         @foreach($insurances as $insurance)
                            <option value="{{$insurance->id}}">{{$insurance->id}}</option>
                         @endforeach
                    </select>
                </div>

                <div class="form-entry">
                    <button type="submit" class="btn btn-success">Generuoti</button>
                </div>
            </div>
        </form>
    </div>

@endsection
