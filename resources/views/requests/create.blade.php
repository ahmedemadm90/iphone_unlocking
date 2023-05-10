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
    New Request
@endsection

@section('content')
    @include('layouts.errors')
    <!--Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card">

                @if (Auth::user()->role->role_name == 'admin')
                <div class="card-header">
                    <a href="{{ route('requests.index') }}" class="btn btn-primary">Back</a>
                </div>
                @else
                <div class="card-header">
                    <a href="{{ route('user.requests.index') }}" class="btn btn-primary">Back</a>
                </div>
                @endif
                <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data" class="w-50 m-auto">
                    @csrf
                    <div class="card-body">
                        <div id="">
                            <div class="row ">
                                <div class="col-md col-lg">
                                    <label class="form-control-label">Amount: <span class="tx-danger">*</span></label>
                                    <input class="form-control" id="amount" name="amount" placeholder="Amount"
                                        required="" type="number">
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
