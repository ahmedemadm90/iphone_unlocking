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
    Update Device
@endsection
@section('content')
    @include('layouts.errors')
    <!--Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('devices.index') }}" class="btn btn-primary">Back</a>
                </div>
                <form method="POST" class="w-50 m-auto" action="{{ route('devices.update',$device->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div id="">
                            <div class="row ">
                                <div class="col-md col-lg">
                                    <label class="form-control-label">Device name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" id="firstname" name="device_name" placeholder="Enter Device Name"
                                        required="" type="text" value="{{$device->device_name}}">
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md col-lg">
                                    <label class="form-control-label">Unlocking Cost: <span class="tx-danger">*</span></label>
                                    <input class="form-control" id="unlock_cost" name="unlock_cost" placeholder="Enter Unlocking Cost"
                                        required="" type="number" value="{{$device->unlock_cost}}">
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

