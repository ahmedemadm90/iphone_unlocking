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
    Recharging Request
@endsection
@section('content')
    @include('layouts.sessions')
    @if (Auth::user()->role_id == 1)
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
                                                <th class="border-bottom-0">User</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Amount</th>
                                                <th class="border-bottom-0">State</th>
                                                <th class="border-bottom-0">Request Date</th>
                                                <th class="border-bottom-0">Request Serial</th>
                                                <th class="border-bottom-0">Tools</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\Request::all() as $request)
                                                <tr>
                                                    <td>{{ $request->user->name }}</td>
                                                    <td>{{ $request->user->email }}</td>
                                                    <td>{{ $request->amount }}</td>
                                                    <td>{{ $request->state }}</td>
                                                    <td>{{ $request->created_at }}</td>
                                                    <td>{{ $request->request_serial }}</td>
                                                    @if ($request->state == 'pending')
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary" type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item text-success"
                                                                        href="{{route('requests.approve',$request->id)}}">Approve</a>
                                                                </li>
                                                                <li><a class="dropdown-item text-primary"
                                                                        href="{{route('requests.decline',$request->id)}}">Decline</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <span class="badge bg-success">{{$request->state}}</span>
                                                    </td>
                                                    @endif
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
    @else
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('requests.create') }}" class="btn btn-primary">Create Request</a>
                </div>
                <div class="card-body">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">User</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Amount</th>
                                                <th class="border-bottom-0">Request Date</th>
                                                <th class="border-bottom-0">State</th>
                                                <th class="border-bottom-0">Request Serial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\Request::where('user_id',Auth::user()->id)->get() as $request)
                                                <tr>
                                                    <td>{{ $request->user->name }}</td>
                                                    <td>{{ $request->user->email }}</td>
                                                    <td>{{ $request->amount }}</td>
                                                    <td>{{ $request->created_at }}</td>
                                                    <td>{{ $request->state }}</td>
                                                    <td>{{ $request->request_serial }}</td>
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
    @endif
    <!-- Row -->

    <!-- End Row -->

@endsection
