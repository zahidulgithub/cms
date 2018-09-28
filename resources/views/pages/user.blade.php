@extends('layouts.app')

@section('content')
    <h1>User id: {{$id}}</h1>
    @endsection


@section('footer')
        <script>  alert('Hello user...page');</script>
    @stop