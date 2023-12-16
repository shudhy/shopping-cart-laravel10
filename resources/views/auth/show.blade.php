@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Show User</div>
            <div class="card-body">
                <form action="#" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                           
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Role" class="col-md-4 col-form-label text-md-end text-start">Role</label>
                        <div class="col-md-6">
                        <select name="role" class="form-select" aria-label="Default select example" disabled>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                        </div>
                    </div>
                    
                    <a href="{{ route('users.index') }}" class="btn btn-md btn-primary">Kembali</a>
                    
                    
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
