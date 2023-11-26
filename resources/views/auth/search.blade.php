@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
    <div class="row">
            <div class="col-md-2 mb-3 "><a href="{{ route('users.create') }}" class="btn btn-primary stretched-link">Tambah</a></div>
            
           
            <div class="col-md-3">
            <form action="{{ route('users.search') }}" method="GET">
            
                <div class="input-group mb-3">
                    <input type="text" name="query" class="form-control" placeholder="Search by nama, kode" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
            </div>
            
        </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary">Show</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary">Edit</a>
                    </div>
                    </td>
                    </tr>
                @endforeach  
                </tbody>
                </table>
                {{ $users->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection