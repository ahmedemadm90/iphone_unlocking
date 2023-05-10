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
@if (Auth::user()->role == 'admin')
    @section('cards')
        @include('layouts.cards')
    @endsection
@endif
@section('title')
    Dashboard
@endsection
@section('content')
@include('layouts.sessions')
    <div class="card">
        <table class="table table-borderd text-center">
            <thead>
                <tr>
                    <td>Devices</td>
                    <td>Unlocking Cost</td>
                </tr>
            </thead>
            <tbody>
                @if (App\Models\Device::count() > 1)
                    @foreach (App\Models\Device::all() as $device)
                        <tr>
                            <td>{{ $device->device_name }}</td>
                            <td>{{ $device->unlock_cost }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">No Devices</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
@endsection
