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
    Update Wallet
@endsection
@section('content')
    @include('layouts.errors')
    <!--Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('wallets.index') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-2 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{route('wallets.update',$wallet->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="country" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Company</label>
                                            <input type="text" name="wallet_company" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Number</label>
                                            <input type="text" name="wallet_number" class="form-control" />
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--/Row-->
@endsection
@section('scripts')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
