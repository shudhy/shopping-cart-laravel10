<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel 10 Shopping Cart Example - LaravelTuts.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-warning bg-gradient">
    <div class="container-sm">
          <a class="navbar-brand" href="{{ URL('/welcome') }}">Dusna Store</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
            @if (Auth::check() && Auth::user()->role === 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Master
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li><a class="dropdown-item" href="{{ URL('/itemx') }}" >Item</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Penjualan
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li><a class="dropdown-item" href="{{ route('laporan.index') }}" >Rekap Penjualan</a></li>
                        <li><a class="dropdown-item" href="{{ route('detailpenjualan.index') }}" >Detail Penjualan</a></li>
                </ul>
            </li>
            @endif
                @guest
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Penjualan
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li><a class="dropdown-item" href="{{ route('laporan.index') }}" >Rekap Penjualan</a></li>
                        <li><a class="dropdown-item" href="{{ route('detailpenjualan.index') }}" >Detail Penjualan</a></li>
                </ul>
            </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>

                    <div class="dropdown" >
                        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Cart <span class="badge bg-light text-dark">{{ count((array) session('cart')) }}</span>
                        </a>
                    </div>
                @else    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('users.gantipassword', Auth::user()->id) }}" >Ganti Password</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </li>

                    <div class="dropdown" >
                        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Cart <span class="badge bg-light text-dark">{{ count((array) session('cart')) }}</span>
                        </a>
                    </div>
                @endguest
            </ul>
          </div>
        </div>
    </nav>    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mt-4">
            {{ session('success') }}
            </div> 
        @endif
        @yield('content')
    </div>
  
@yield('scripts')



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>

    
$(document).ready(function() {
   



    $('#status_order').on('change', function() {
    // Dapatkan nilai status yang dipilih
    var newStatus = $(this).val();
    
    // Dapatkan token CSRF dari tag meta
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Kirim permintaan AJAX ke server untuk memperbarui status
    $.ajax({
        type: 'PUT', // Sesuaikan dengan metode HTTP yang Anda gunakan
        url: '{{ route("update-status", $cart) }}', // Gantilah dengan URL rute yang sesuai
        data: {
            newStatus: newStatus,
            _token: csrfToken // Tambahkan token CSRF ke data
        },
        success: function(response) {
            // Penanganan sukses jika diperlukan
            console.log(response);
        },
        error: function(error) {
            // Penanganan kesalahan jika terjadi
            console.error(error);
        }
    });
});


        $('#simpanSemua').on('click', function() {

            
            var updates = []; // Array untuk menyimpan perubahan quantity

            // Loop melalui semua input quantity
            $('.quantity-input').each(function() { 
                var itemID = $(this).data('item-id');
                var newQuantity = $(this).val();
                var selectedSatuan = $(this).closest('tr').find('.satuan-select').val();
                var newDataPrice = $(this).closest('tr').find('.data-price').text();



                // console.log('itemID:', itemID);
                // console.log('newQuantity:', newQuantity);
                // console.log('selectedSatuan:', selectedSatuan);
                // console.log('newDataPrice:', newDataPrice);
               
                // Menambahkan perubahan ke dalam array updates
                updates.push({
                    itemID: itemID,
                    newQuantity: newQuantity,
                    selectedSatuan: selectedSatuan,
                    newDataPrice: newDataPrice
                });
            });



            // Mendapatkan token CSRF dari tag meta
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            // Kirim permintaan AJAX ke server untuk memperbarui quantity item
            $.ajax({
                type: 'PUT', // Sesuaikan dengan metode HTTP yang Anda gunakan
                url: '/update-quantities', // Ganti dengan URL Anda yang sesuai
                data: {
                    updates: updates,
                    _token: csrfToken // Tambahkan token CSRF ke data
                },
                success: function(response) {
                    window.location.replace('{{ route("laporan.index") }}');
                },
                error: function(error) {
                    // Penanganan kesalahan jika terjadi
                    console.error(error);
                }
            });
        });





                    $('#selecteditemTable tbody').on('click', '.hapus-item', function () {
                        
                        var row = $(this).closest('tr');
                        var itemID = $(this).data('item-id');

                    //    console.log('itemID:', itemID);
                        // Kirim permintaan AJAX untuk menghapus item di sisi server
                        $.ajax({
                            type: 'DELETE', // Sesuaikan dengan metode HTTP yang sesuai
                            url: '/delete-item/' + itemID, // Ganti dengan URL yang sesuai
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                // Hapus baris (item) dari tabel jika penghapusan di sisi server berhasil
                                row.remove();
                            },
                            error: function (error) {
                                // Penanganan kesalahan jika terjadi
                                console.error(error);
                            }
                        });
                        

                    });



           
        });



$(document).ready(function() {


 

                    // Setelah pengguna memilih satuan dari dropdown satuan
                    $('#selecteditemTable').on('change', '.satuan-select', function() {
                        var priceId = $(this).val(); // Mengambil satuan yang dipilih
                        var row = $(this).closest('tr'); // Mengambil baris terkait

                        

                        // Mengambil harga berdasarkan ID produk dan satuan yang dipilih (menggunakan AJAX)
                        $.ajax({
                            url: '/get-harga/' + priceId ,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                // Memperbarui harga dalam kolom harga pada baris yang sesuai
                                row.find('.data-price').text(response.harga);
                                row.find('.subtotal').data('price', response.harga);

                                // Menghitung subtotal saat item ditambahkan
                                calculateSubtotal();
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat mengambil data harga.');
                            }
                        });
                    });

                    // Memantau perubahan pada input jumlah (quantity)
                    $('#selecteditemTable').on('input', '.quantity-input', function() {
                        calculateSubtotal();
                    });

                    function calculateSubtotal() {
                        var total = 0;
                        $('#selecteditemTable tbody tr').each(function() {
                            var quantity = parseInt($(this).find('.quantity-input').val());
                            var price = parseFloat($(this).find('.subtotal').data('price'));
                            var subtotal = quantity * price;

                           // Pastikan quantity tidak sama dengan 0
                            if (!isNaN(quantity) && !isNaN(price) && quantity !== 0) {
                                var subtotal = quantity * price;
                                $(this).find('.subtotal').text(formatNumber(subtotal.toFixed(0))); // Memformat dan menampilkan subtotal
                                total += subtotal;
                            }
                        });

                        // Memperbarui total dengan pemisah ribuan
                         $('#totalAmount').text(formatNumber(total.toFixed(0)));
                    }
                    // Fungsi untuk memformat angka dengan pemisah ribuan
                    function formatNumber(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }


                    
                });
  
        

               

    </script>


</body>
</html>