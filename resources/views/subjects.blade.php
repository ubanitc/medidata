@extends('layouts.app')

@section('content')
        @livewire('subjects-table',['study'=>$study, 'site'=>$site])
@endsection
