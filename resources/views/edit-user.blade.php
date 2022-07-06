@extends('layouts.app')
@section('content')
    <section style="background-color: #eee; border-radius: 10px">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ucwords($user->name)}}</h5>
                            @if($user->is_admin)
                                <p class="text-muted mb-1">
                                    Admin
                                </p>
                            @endif
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-primary">Edit</a>
                                {{--                                <a href="{{ route('users.destroy',['user'=>$user->id]) }}">destory</a>--}}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-small" class="btn btn-outline-danger ms-1">Delete</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ucwords($user->name)}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->username}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$user->openpassword}}</p>
                                </div>
                            </div>
                            <hr>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Are you sure?</div>
                    <div>If you proceed, this user will be deleted permanently.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('users.destroy',['user'=>$user->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete user</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
