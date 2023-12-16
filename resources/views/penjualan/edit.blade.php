@extends('shopedit')

@section('content')

<div class="row justify-content-center mt-3">
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
                    <label class="cartID">{{ $cart->id }}</label> <br>
                    <div id="cart-data" data-cart-id="{{ $cart->id }}" style="display: none;"></div>


                    <label>Tgl Penjualan : </label>
                    <label>{{ $cart->tanggal }}</label> <br>

                    <label>Pelnggan : </label>
                    <label>{{ $cart->user->name }}</label> <br>
                    
               
                    <label>Status Order : </label>
                    <select class="form-select" id="status_order" name="status_order">
                        <option value="baru" {{ $cart->status_order === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="proses" {{ $cart->status_order === 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="dikirim" {{ $cart->status_order === 'dikirim' ? 'selected' : '' }}>dikirim</option>
                        <option value="diterima" {{ $cart->status_order === 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="tolak" {{ $cart->status_order === 'tolak' ? 'selected' : '' }}>Di tolak</option>
                    </select> <br>
                   
                </div>
            </div>

                        
                
            </div>
            <div style="overflow-x: auto;">
            <table class="table table-hover" id="selecteditemTable">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">kode produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Action</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                @foreach($cartItems as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->product_id }}</td>
                    <td>{{ $laporan->product->name }}</td>
                    <?php $subtotal = $laporan->price * $laporan->quantity; ?>
                    <td><input type="number" class="quantity-input" style="width:30px;" id="quantityInput{{ $index }}" data-item-id="{{ $laporan->id }}" value="{{ $laporan->quantity }}" ></td>
                    <td>
                        <select class="satuan-select" data-product-id="{{ $laporan->product_id }}">
                            @foreach ($laporan->product->prices as $price)
                            @if (!empty($price->unit->name))
                            <option value="{{ $price->id }}" {{ $price->id == $laporan->unit ? 'selected' : '' }}>
                                {{ $price->unit->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </td>
                    <td class="data-price" >{{ $laporan->price }}</td>
                    <td class="subtotal" data-price="{{ $laporan->price }}">{{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td><button class="hapus-item" data-item-id="{{ $laporan->id }}">Hapus</button></td>
                </tr>
                <?php $total += $subtotal; ?>
                @endforeach
                
                </tbody>
                </table>
</div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: right;"><strong>Total Belanja:</strong> <strong id="totalAmount" >{{ number_format($total, 0, ',', '.') }}</strong></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: right;"><strong>Ongkos Kirim:</strong> <strong >{{ number_format($cart->ongkos_kirim, 0, ',', '.') }}</strong></div>
                </div>
                <?php $total += $cart->ongkos_kirim; ?>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: right;"><strong>Total:</strong> <strong >{{ number_format($total, 0, ',', '.') }}</strong></div>
                </div>
                
                <div class="row">
                <div class="col-md-12"><button id="simpanSemua" class="btn btn-primary" type="button">Simpan</button></div>
                </div>
                
                
    </div>    
</div>
    
@endsection
