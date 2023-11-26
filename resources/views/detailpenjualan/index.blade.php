@extends('shop')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 ">
            
            </div>
            
           
           
            
        </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tgl</th>
                    <th scope="col">No penjualan</th>
                    <th scope="col">kode produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Total</th>
                    
                    
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
                    <td>{{ $laporan->prices->unit->name }}</td>
                    <td>{{ number_format($laporan->price, 0, ',', '.') }}</td>
                    <td>{{ number_format($laporan->price * $laporan->quantity, 0, ',', '.') }}</td>
                   
                    </tr>
                @endforeach  
                </tbody>
                </table>
                {{ $report->links('vendor.pagination.default') }}
    </div>    
</div>
    
@endsection
