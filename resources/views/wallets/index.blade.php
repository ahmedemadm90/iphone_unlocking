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
    All Wallets
@endsection
@section('bage-header')
    All Wallets
@endsection
@section('content')
    @include('layouts.sessions')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('wallets.create') }}" class="btn btn-primary">Create New Wallet</a>
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
                                                <th class="border-bottom-0">Country</th>
                                                <th class="border-bottom-0">Wallet Company</th>
                                                <th class="border-bottom-0">Wallet Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (App\Models\CashWallet::all() as $wallet)
                                                <tr>
                                                    <td>{{ $wallet->country }}</td>
                                                    <td>{{ $wallet->wallet_company }}</td>
                                                    <td>{{ $wallet->wallet_number }}</td>
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
