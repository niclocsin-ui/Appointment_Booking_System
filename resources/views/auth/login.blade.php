@extends('layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="card p-4">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="bg-light d-inline-block rounded-circle p-3 mb-2">
                        <i class="bi bi-person-fill text-primary fs-2"></i>
                    </div>
                    <h4 class="fw-bold">Welcome Back</h4>
                    <p class="text-muted small">Please sign in to your account</p>
                </div>

                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-primary w-100 py-2 shadow-sm">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection