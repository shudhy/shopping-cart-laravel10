@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Tambah User</div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                @method('PUT')
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" readonly>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="current_password" class="col-md-4 col-form-label text-md-end text-start">Current Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @if ($errors->has('current_password'))
                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-end text-start">New Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="new_password" name="new_password" >
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="confirm_password" class="col-md-4 col-form-label text-md-end text-start">Confirm New Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror"" id="confirm_password" name="confirm_password" >
                          @if ($errors->has('confirm_password'))
                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Role" class="col-md-4 col-form-label text-md-end text-start">Role</label>
                        <div class="col-md-6">
                        <select name="role" class="form-select" aria-label="Default select example" >
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
