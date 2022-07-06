@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
{{--                    <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/>--}}
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        New user
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @foreach($users as $user)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                <span
                                    class="avatar avatar-xl mb-3 avatar-rounded">{{ mb_substr($user->name, 0 ,1)}}</span>
                                <h3 class="m-0 mb-1">{{ ucwords($user->name) }}</h3>
                                {{--                            <div class="text-muted">Chemical Engineer</div>--}}
                                @if($user->is_admin)
                                    <div class="mt-3">
                                        <span class="badge bg-green-lt">Admin</span>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <span class="badge bg-secondary-lt">User</span>
                                    </div>
                                @endif

                            </div>
                            <a href="{{ route('users.show', ['user'=>$user->id ]) }}" class="card-btn">View full profile</a>

                        </div>
                    </div>
                @endforeach

                <div class="d-flex mt-4">
                    <ul class="pagination ms-auto">
                        <li class="page-item">
                            {{ $users->links() }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Full Name(Required)">
                        </div><div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Email(Required)">
                        </div><div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username(Required)">
                        </div><div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" placeholder="Password(Required)">
                        </div>


                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            Create new user
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
