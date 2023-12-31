@extends('shop')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 "><a href="{{ route('item.add') }}" class="btn btn-primary stretched-link">Tambah</a></div>
            <div class="col-md-3">
            <form action="{{ route('products.search') }}" method="GET">
            
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
                    <th scope="col">Image</th>
                    <th scope="col">kategori</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $index => $product)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="col-lg-1">
                            <img class="img-fluid" src="/storage/images/{{ $product->image }}" alt="Gambar Produk">
                       
                    </td>
                    <td>{{ $product->category->nama }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{ route('item.show', $product->id) }}" class="btn btn-outline-primary">Show</a>
                    <a href="{{ route('item.edit', $product->id) }}" class="btn btn-outline-primary">Edit</a>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('item.destroy', $product->id) }}" method="POST">
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
                {{ $products->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection
