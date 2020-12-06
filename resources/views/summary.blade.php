@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Planų užsakymų ataskaita</h1>
        <hr>
        <ul class="list-group">
        @foreach($plans as $plan)
                <li
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex justify-content-between flex-column">
                        <span class="font-weight-bold">
                            {{ $plan->name }}
                        </span>
                    </div>
                    <div>
                       Užsakymų skaičius: <span class='text-primary font-weight-bold'>{{ $plan->orderd_plans_count }}</span>
                    </div>
                </li>
        @endforeach
        </ul>
    </div>
@endsection