@extends('shop')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 ">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('kategori.create') }}" class="btn btn-primary stretched-link">Tambah</a>
                @endif
            </div>
            
        </div>
        <div style="overflow-x: auto;">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tgl</th>
                    <th scope="col">No penjualan</th>
                    <th scope="col">kode produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Harga</th>
                    @if(Auth::user()->role === 'admin')
                    <th scope="col">Action</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                <?php $startIndex = ($report->currentPage() - 1) * $report->perPage(); ?>
                @foreach($report as $index => $laporan)
                    <tr>
                    <td>{{ $startIndex + $index + 1 }}</td>
                    <td>{{ $laporan->created_at }}</td>
                    <td>{{ $laporan->cart_id }}</td>
                    <td>{{ $laporan->product_id}}</td>
                    <td>{{ $laporan->product->name }}</td>
                    <td>{{ $laporan->quantity }}</td>
                    <td>{{ number_format($laporan->price, 0, ',', '.') }}</td>
                    @if(Auth::user()->role === 'admin')
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{ route('kategori.show', $laporan->id) }}" class="btn btn-outline-primary">Show</a>
                    <a href="{{ route('kategori.edit', $laporan->id) }}" class="btn btn-outline-primary">Edit</a>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $laporan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-primary">Delete</button>
                        </form>
                    </div>
                    </td>
                    @endif
                    </tr>
                @endforeach  
                </tbody>
                </table>
</div>
                {{ $report->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection
