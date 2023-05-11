@extends('layout.master')

@section('content')
    <div class="flex flex-row">
    @include('partial.tab_profile')
    @yield('content_profile')
    </div>
@endsection
@section('script')
    @yield('script_account')
@endsection
