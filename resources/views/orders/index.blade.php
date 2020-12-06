@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Užsakyti planai</h1>
        <hr>
        @include('success')
        <ul class="list-group">
        @foreach($insurances as $plan)
                <li
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex justify-content-between flex-column">
                        <span class="font-weight-bold">
                            {{ $plan->user->first_name }}  {{ $plan->user->last_name }}
                        </span>
                        <span class="font-italic">
                            <span class="font-weight-lighter mr-4"> {{ $plan->insurance->name }} </span>
                            @if(isset($plan->valid_till))
                                <span> <b> Galioja iki:</b> {{ $plan->valid_till }} </span>
                            @endif
                        </span>
                    </div>
                    <div>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('approve', $plan->id) }}" class="btn btn-outline-success">Patvritinti</a>
                            @else
                                <p><b>Statusas: </b><?php echo $plan->approved ? "<span style='color: darkgreen;'>Patvirtinta</span>" : "<span style='color: darkred;'>Nepatvrtinta</span>"; ?></p>
                            @endif
                        @endauth
                    </div>
                </li>
        @endforeach
        </ul>
    </div>
@endsection







