@extends('shop')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 "><a href="{{ route('kategori.create') }}" class="btn btn-primary stretched-link">Tambah</a></div>
            
           
            <div class="col-md-3">
            <form action="{{ route('kategori.search') }}" method="GET">
            
                <div class="input-group mb-3">
                    <input type="text" name="query" class="form-control" placeholder="Search by nama, kode, or kategori" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
            </div>
            
        </div>
        <div style="overflow-x: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $startIndex = ($categories->currentPage() - 1) * $categories->perPage(); ?>
                @foreach($categories as $index => $kategori)
                    <tr>
                    <td>{{ $startIndex + $index + 1 }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-outline-primary">Show</a>
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-outline-primary">Edit</a>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                    </td>
                    </tr>
                @endforeach  
                </tbody>
                </table>
</div>
                {{ $categories->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection
