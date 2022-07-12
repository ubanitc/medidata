@extends('layouts.app')

@section('content')
    <div class="col-12 mb-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                            <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-hipchat -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.802 17.292s.077 -.055 .2 -.149c1.843 -1.425 2.998 -3.49 2.998 -5.789c0 -4.286 -4.03 -7.764 -8.998 -7.764c-4.97 0 -9.002 3.478 -9.002 7.764c0 4.288 4.03 7.646 9 7.646c.424 0 1.12 -.028 2.088 -.084c1.262 .82 3.104 1.493 4.716 1.493c.499 0 .734 -.41 .414 -.828c-.486 -.596 -1.156 -1.551 -1.416 -2.29z" /><path d="M7.5 13.5c2.5 2.5 6.5 2.5 9 0" /></svg>                            </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Open Queries
                        </div>
                        <div class="text-muted">
                            {{ $main_query->count() + $sub_query->count() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <a href="{{ route('querypdf', $id) }}" class="btn btn-success mt-2">Export as PDF</a>

    </div>
    <div class="col-12">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>                            </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            Needs verification
                        </div>
                        <div class="text-muted">
                            {{ $unverified->count() + $subunverified->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('downloadpdf', $id) }}" class="btn btn-primary mt-2">Export as PDF</a>

    </div>
@endsection
