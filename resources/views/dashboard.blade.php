@extends('layouts.base')

@section('content')
    Haloo {{ auth()->user()->name }}
@endsection