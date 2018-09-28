@extends('layouts.app')

@section('content')
    <h2>hello About page...</h2>





    @stop

@if(count($user))

    <ul>

        @foreach($user as $person)

            <li> {{$person}} </li>

        @endforeach

    </ul>
@endif