@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2> Admin Login</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary"> Login</button>

        <p class="mt-3">Not registered? 
            <a href="{{ route('admin.register.form') }}" class="btn btn-outline-success"> Register as Admin</a>
        </p>
    </form>
</div>
@endsection
