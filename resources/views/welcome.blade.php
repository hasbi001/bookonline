@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Admin</div>

                <div class="card-body">
                    <a href="{{ url('/login/admin') }}">Login Admin</a> | <a href="{{ url('/register/admin') }}">Register Admin</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">member</div>

                <div class="card-body">
                    <a href="{{ url('/login/member') }}">Login Member</a> | <a href="{{ url('/register/member') }}">Register Member</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
