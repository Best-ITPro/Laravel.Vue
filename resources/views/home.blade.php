@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                <center><h2>Vue.JS</h2></center>
                <br>
                <center>
                    <example-component></example-component>
                </center>
                <br>

                <center>
                    <a href="{{ route('start') }}"><h3>All Vue.JS Components</h3></a>
                </center>

            </div>
        </div>
    </div>
</div>
@endsection
