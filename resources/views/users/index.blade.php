@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebar')
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
@section('title')
    All Users
@endsection
@section('bage-header')
    All Users
@endsection
@section('content')
    @include('layouts.sessions')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                {{-- <div class="card-header">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a>
                </div> --}}
                <div class="card-body">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">Name</th>
                                                <th class="border-bottom-0">Role</th>
                                                <th class="border-bottom-0">Phone</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Wallet</th>
                                                <th class="border-bottom-0">Tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\User::all() as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->role->role_name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->wallet }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary" type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item text-success"
                                                                        href="">Show</a>
                                                                </li>
                                                                <li><a class="dropdown-item text-primary"
                                                                        href="">Edit</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
