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
    New Unlock Request
@endsection

@section('content')
    @include('layouts.errors')
    <!--Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                @if (Auth::user()->role->role_name == 'admin')
                <div class="card-header">
                    <a href="{{ route('unlock.requests.index') }}" class="btn btn-primary">Back</a>
                </div>
                @else
                <div class="card-header">
                    <a href="{{ route('user.unlock.requests.index') }}" class="btn btn-primary">Back</a>
                </div>
                @endif
                <form method="POST" action="{{ route('unlock.requests.store') }}" enctype="multipart/form-data"
                    class="w-50 m-auto">
                    @csrf
                    <div class="card-body">
                        <div id="">
                            <div class="row mb-2">
                                <div class="col-md col-lg">
                                    <label class="form-control-label">Device : <span class="text-danger">*</span></label>
                                    <select name="device_id" id="" class="form-control">
                                        <option value="" selected hidden disabled>Select Device To Unlock</option>
                                        @foreach (App\Models\Device::all() as $device)
                                            <option value="{{ $device->id }}">{{ $device->device_name }}  || {{ $device->unlock_cost }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md col-lg">
                                    <label class="form-control-label">Device Serial: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" id="device_serial" name="device_serial" placeholder="Amount"
                                        required="" type="text">
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md col-lg text-center">
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--/Row-->
@endsection
