@extends('shop')
  
@section('content')
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
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    
                    <td>
                    <a href="{{ route('minProduct.to.cart', $id) }}" class="btn btn-primary btn-sm" id="mines">-</a>    
                    <input type="number" class="quantity-input" style="width:30px;" value="{{$details['quantity']}}" readonly>
                    <a href="{{ route('addProduct.to.cart', $id) }}" class="btn btn-primary btn-sm" id="plus">+</i></a>
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
           

                 <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat Tujuan :</td>
                    <td><input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"></td>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Desa :</td>
                    <td>
                    <select class="form-select @error('desa_tujuan') is-invalid @enderror" name="desa_tujuan" aria-label="Default select example">
                    <option value="" disabled selected>Pilih Desa Tujuan</option>
                        @foreach ($ongkirList as $ongkir)
                        <option value="{{ $ongkir->id }}"  data-ongkos="{{ $ongkir->biaya }}" {{ (old('desa_tujuan') == $ongkir->id) ? 'selected' : '' }}>{{ $ongkir->desa_tujuan }}</option>
                        @endforeach
                        </select>
                        @error('desa_tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>No TLPN : </td>
                    <td><input type="text" name="tlpn" class="form-control @error('tlpn') is-invalid @enderror" value="{{ old('tlpn') }}"></td>
                    @error('tlpn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ongkir : </td>
                    <td></td>
                    <td><input type="text" id="ongkos_kirim" name="ongkos_kirim" class="form-control" value="{{ old('ongkos_kirim') }}"  readonly></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pembayaran : </td>
                    <td>
                    <select class="form-select @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" aria-label="Default select example">
                        <option selected>Pilih Metode Pembayaran</option>
                        <option value="1">COD</option>
                        <option value="2">Tranfer (BRI 1076 0100 5874 509/I PUTU SUDI SUASTAWA)</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td>Total Bayar :</td>
                    <td>
                    <strong id="totalAmount">{{$total}}</strong>
                    </td>
                    <td></td>
                </tr>

                @else
    <p>Keranjang belanja Anda kosong.</p>
                
        @endif

    </tbody>

    <tfoot>
        <tr>
            <td class="text-right">
                <a href="{{ url('/welcome') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button type="submit" class="btn btn-danger">Checkout</button>
            </td>
            <td></td>
        </tr>
    </tfoot>
    </form>
</table>
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