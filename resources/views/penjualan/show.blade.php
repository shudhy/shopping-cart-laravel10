@extends('shop')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2 mb-3 "><a href="{{ route('laporan.index') }}" class="btn btn-primary stretched-link">Kembali</a>
        </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Detail Penjualan
                </div>
                <div class="card-body">
                <label>No Penjualan : </label>
                <label>{{ $cart->id }}</label> <br>

                <label>Tgl Penjualan : </label>
                <label>{{ $cart->tanggal }}</label> <br>

                <label>Pelnggan : </label>
                <label>{{ $cart->user->name }}</label> <br>

                <label>Status Order : </label>
                <label>{{ $cart->status_order }}</label>
                </div>
            </div>   
                
            </div>

            <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Tujuan Kirim
                </div>
                <div class="card-body">
                <label>Alamat  : </label>
                <label>{{ $cart->alamat_tujuan ?? 'Tidak Ada Alamat' }}</label> <br>

                <label>Desa : </label>
                <label>{{ $cart->ongkir->desa_tujuan ?? 'Tidak Ada Desa Tujuan' }}</label> <br>

                <label>No Telpn : </label>
                <label>{{ $cart->no_tlpn ?? 'Tidak Ada No Tlpn' }}</label> <br>

                <label>Metode Pembayaran : </label>
                <label>{{ $cart->metode_pembayaran == 1 ? 'COD' : ($cart->metode_pembayaran == 2 ? 'Transfer' : 'tunai') }}
</label>
                </div>
            </div>

</div>

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">kode produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                @foreach($cartItems as $index => $laporan)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->product_id}}</td>
                    <td>{{ $laporan->product->name}}</td>
                    <td>{{ $laporan->quantity }}</td>
                    <td>{{ $laporan->prices->unit->name}}</td>
                    <td>{{ number_format($laporan->price, 0, ',', '.') }}</td>
                    <?php $subtotal = $laporan->price * $laporan->quantity; ?>
                    <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td>
                    </tr>
                    <?php $total += $subtotal; ?>
                @endforeach 
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;"><strong>Total Belanja :</strong></td>
                    <td><strong>{{  number_format($total, 0, ',', '.')}} </strong></td>

                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;"><strong>Ongkos Kirim :</strong></td>
                    <td><strong>{{  number_format($cart->ongkos_kirim, 0, ',', '.')}} </strong></td>

                </tr>
                <?php $total += $cart->ongkos_kirim; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;"><strong>Total Tagihan :</strong></td>
                    <td><strong>{{ number_format($total, 0, ',', '.') }} </strong></td>

                </tr>
                
                </tbody>
                </table>

                
    
</div>
    
@endsection
