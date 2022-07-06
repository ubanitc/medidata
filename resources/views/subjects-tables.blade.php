@extends('layouts.subjects-dash')
@section('content')

                @livewire('dashboard-content' , ['subject' => $subject])

@endsection
