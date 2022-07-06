@extends('layouts.app')


@section('content')
    @livewire('sites-table', ['study' => $study])
@endsection
