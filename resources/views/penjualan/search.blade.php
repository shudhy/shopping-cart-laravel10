@extends('shop')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 ">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('laporan.create') }}" class="btn btn-primary stretched-link">Tambah</a>
            @endif
            </div>
            
           
            <div class="col-md-3">
            <form action="{{ route('laporan.search') }}" method="GET">
            
                <div class="input-group mb-3">
                    <input type="text" name="query" class="form-control" placeholder="Search by No penjualan,customer" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
            </div>
            
        </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tgl</th>
                    <th scope="col">No penjualan</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Status Order</th>
                    <th scope="col">Total</th>
                    @if(Auth::user()->role === 'admin')
                    <th scope="col">Action</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($report as $index => $laporan)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->tanggal }}</td>
                    <td>{{ $laporan->id }}</td>
                    <td>{{ $laporan->user->name }}</td>
                    <td><button type="button" class="btn btn-sm {{ $laporan->status_order === 'baru' ? 'btn-primary' : ($laporan->status_order === 'diterima' ? 'btn-danger' : 'btn-warning') }}">
        {{ $laporan->status_order }}
    </button></td>
                    <td>
                    @php
                            $total = 0;
                        @endphp
                        @foreach($laporan->cart_items as $cartItem)
                            @php
                                $total += $cartItem->quantity * $cartItem->price;
                            @endphp
                        @endforeach
                        {{ number_format($total, 0, ',', '.') }}
                    </td>
                    @if(Auth::user()->role === 'admin') 
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-outline-primary">Show</a>
                    <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-outline-primary">Edit</a>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('laporan.destroy', $laporan->id) }}" method="POST">
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
                {{ $report->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection
