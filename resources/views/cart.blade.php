@extends('shop')
  
@section('content')
<table id="cart" class="table table-bordered mt-4">
@if(session('cart'))
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
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
                    @php 
                    $price =$details['price'] 
                    @endphp
                    <div data-th="Price"> @php $details['price'] @endphp</div>
                    <td>Rp.{{ number_format($price, 0, ',', '.') }}</td>
                    <td data-th="qty"> 
                    <a href="{{ route('minProduct.to.cart', $id) }}" class="btn btn-primary btn-sm">-</a>    
                    {{$details['quantity']}}

                    <a href="{{ route('addProduct.to.cart', $id) }}" class="btn btn-primary btn-sm">+</i></a>
                    </td>
                    @php 
                    $stotal =$details['price'] * $details['quantity'] 
                    @endphp
                    <div data-th="Subtotal" class="text-center">@php $details['price'] * $details['quantity'] @endphp </div>
                    <td class="text-center">Rp.{{ number_format($stotal, 0, ',', '.') }} </td>
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
                    <td>Total :</td>
                    <td>

                    <input type="text" id="total_pembelian" name="total_pembelian" class="form-control" value="{{ $total }}"readonly hidden>
                    <input type="text"  class="form-control" value="Rp.{{ number_format($total, 0, ',', '.') }}"readonly>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat Tujuan :</td>
                    <td><input type="text" name="alamat" class="form-control"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Desa :</td>
                    <td>
                    <select class="form-select" name="desa_tujuan" aria-label="Default select example">
                        <option selected>Pilih Desa Tujuan</option>
                        @foreach ($ongkirList as $ongkir)
                        <option value="{{ $ongkir->id }}" data-ongkos="{{ $ongkir->biaya }}">{{ $ongkir->desa_tujuan }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>No TLPN :</td>
                    <td><input type="text" name="tlpn" class="form-control"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ongkir :</td>
                    <td></td>
                    <td><input type="text" id="ongkos_kirim" name="ongkos_kirim" class="form-control" readonly></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pembayaran :</td>
                    <td>
                    <select class="form-select" name="metode_pembayaran" aria-label="Default select example">
                        <option selected>Pilih Metode Pembayaran</option>
                        <option value="1">COD</option>
                        <option value="2">Tranfer</option>
                        </select>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td>Total Bayar :</td>
                    <td>
                    <input type="text" id="total_bayar" name="total_bayar" class="form-control" readonly>
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

    $(document).ready(function() {
        $('.quantity-input').on('change', function() {
            var quantity = $(this).val();
            var price = $(this).closest('tr').find('[data-th="Price"]').text().replace('Rp', '');
            var subtotal = quantity * price;
            $(this).closest('tr').find('[data-th="Subtotal"]').text('Rp' + subtotal);
          
            // Menghitung total
        var total = 0;
        $('[data-th="Subtotal"]').each(function() {
            var subtotal = parseInt($(this).text().replace('Rp', ''));
            total += subtotal;
        });

        // Menampilkan total
        $('[data-th="Total"]').text('Rp' + total);
        });


      
        
        $('select[name="desa_tujuan"]').change(function() {
            var selectedOption = $(this).children("option:selected");
            var ongkosKirim = selectedOption.data('ongkos');
            $('#ongkos_kirim').val(ongkosKirim);
            calculateTotalBayar();
        });

        $('#total_pembelian').change(function() {
            calculateTotalBayar();
        });

        function calculateTotalBayar() {
            var totalPembelian = parseFloat($('#total_pembelian').val());
            var ongkosKirim = parseFloat($('#ongkos_kirim').val());

            var totalBayar = totalPembelian + ongkosKirim;
            var formattedTotalBayar = totalBayar.toLocaleString('id-ID');

            $('#total_bayar').val(formattedTotalBayar);
        }
    });
</script>

 

@endsection