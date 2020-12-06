@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><span class="text-primary">{{$user->first_name}} {{$user->last_name}}</span> naudotojo istorija</h1>
        <hr>
        @foreach($history as $entry)
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div> <span class="font-weight-bold mr-2">{{ $entry->entry }}</span>
                        <span class="font-italic"> {{$entry->insurance->name}} </span>
                    </div>
                    <div class="text-secondary font-italic">{{ $entry->created_at }}</div>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
