@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Naudotojų užsakymų istorija</h1>
        <hr>
        @foreach($users as $user)
            <ul class="list-group">
                <a href="{{ route('history.show', $user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center mb-2">
                    <span class="font-weight-bold mr-2">{{$user->first_name}} {{$user->last_name}}</span> naudotojo istorija
                </a>
            </ul>
        @endforeach
    </div>
@endsection
