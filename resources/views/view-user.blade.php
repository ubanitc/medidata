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
                                <button type="button" onclick="document.getElementById('editform').submit()" class="btn btn-success">Save</button>
{{--                                <a href="{{ route('users.destroy',['user'=>$user->id]) }}">destory</a>--}}
{{--                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-small" class="btn btn-outline-danger ms-1">Delete</a>--}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('users.update',['user'=>$user->id]) }}" id="editform" method="post">

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                    @method('put')
                                    @csrf
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="{{ucwords($user->name)}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="openpassword" class="form-control" value="{{$user->openpassword}}">
                                </div>
                            </div>

                            <hr><div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Role</p>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" name="role" id="">

                                        <option @if($user->is_admin) selected @endif value="1">Admin</option>
                                        <option @if(!$user->is_admin) selected @endif value="0">User</option>
                                    </select>
                                </div>
                            </div>
                            </form>

                            <hr>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
