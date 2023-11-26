@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Ganti Password</div>
            <div class="card-body">
                <form action="{{ route('update.gantipassword', $user->id) }}" method="post">
                @method('PUT')
                    @csrf
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
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Simpan">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
