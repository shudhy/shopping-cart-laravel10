@extends('shop')
  
@section('content')
<div class="row mt-3"></div>
<div style="overflow-x: auto;">
<table class="table table-hover" id="selecteditemTable">
@if(session('cart'))
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    <form action="{{ route('cart.checkout') }}" method="POST">
    @csrf
        @php $total = 0 @endphp
        
            @foreach(session('cart') as $id => $details)
            
           
                
                <tr rowId="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="nomargin">{{ $details['name'] }}</h6>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                    <a href="{{ route('minProduct.to.cart', $id) }}" class="btn btn-primary btn-sm" id="mines">-</a>    
                    <input type="number" class="quantity-input" style="width:40px;" value="{{$details['quantity']}}" readonly>
                    <a href="{{ route('addProduct.to.cart', $id) }}" class="btn btn-primary btn-sm" id="plus">+</i></a>
                    </div>
                </td>
                
                    <td>
                        
                    <select class="satuan-select2">
                    @foreach ($details['units'] as $unit)
                        @if ($unit['name'] !== "" && $unit['name'] > 0)
                            <option value="{{ $unit['id'] }}" @if ($unit['id'] == $details['unit']) selected @endif>{{ $unit['name'] }}</option>
                        @endif
                    @endforeach
                </select>

                    </td>
                    <td class="data-price">{{ $details['price']}} </td>

                    
                    @php 
                    $stotal =$details['price'] * $details['quantity'] 
                    @endphp
                    <td class="subtotal" data-price="{{ $details['price'] }}">{{$stotal}}</td>
                    <td class="actions">
                        <a class="btn btn-outline-danger btn-sm delete-product">Del</i></a>
                    </td>
                    
                </tr>
                

                @php
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;
                @endphp
            @endforeach

            </tbody>

    <tfoot>
        
    </tfoot>
    
</table>
</div>
            <div class="row">
    <div class="col-md-6 mb-3">
    <div class="form-group">
                <label for="alamat">Alamat Tujuan:</label>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="desa">Desa:</label>
                <select class="form-select @error('desa_tujuan') is-invalid @enderror" name="desa_tujuan" aria-label="Default select example">
                <option value="" disabled selected>Pilih Desa Tujuan</option>
                    @foreach ($ongkirList as $ongkir)
                    <option value="{{ $ongkir->id }}"  data-ongkos="{{ $ongkir->biaya }}" {{ (old('desa_tujuan') == $ongkir->id) ? 'selected' : '' }}>{{ $ongkir->desa_tujuan }}</option>
                    @endforeach
                </select>
                @error('desa_tujuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="noTlpn">Nomor Telepon:</label>
                <input type="text" name="tlpn" class="form-control @error('tlpn') is-invalid @enderror" value="{{ old('tlpn') }}">
                @error('tlpn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ongkir">Ongkos Kirim:</label>
                <input type="text" id="ongkos_kirim" name="ongkos_kirim" class="form-control" value="{{ old('ongkos_kirim') }}"  readonly>
            </div>
            <div class="form-group">
                <label for="metodePembayaran">Metode Pembayaran:</label>
                <select class="form-select @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" aria-label="Default select example">
                    <option selected>Pilih Metode Pembayaran</option>
                    <option value="1">COD</option>
                    <option value="2">Tranfer (BRI 1076 0100 5874 509/I PUTU SUDI SUASTAWA)</option>
                </select>
                @error('metode_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="total">Total Bayar:</label>
                <strong id="totalAmount">{{$total}}</strong>
            </div>
    </div>
</div>

                
                
                
                
               

                

                @else
    <p>Keranjang belanja Anda kosong.</p>
                
        @endif

    



<a href="{{ url('/welcome') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
<button type="submit" class="btn btn-danger">Checkout</button>
</form>
@endsection
  
@section('scripts')
<script type="text/javascript">
  
    
  $(".delete-product").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

   
</script>

 

@endsection