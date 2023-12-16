<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belanja kebutuhan sehari hari terlengkap di kotaraya</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    
    
    
</head>
<body>

<nav class="navbar navbar-expand-lg bg-warning bg-gradient fixed-top">
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
                        <li><a class="dropdown-item" href="{{ route('ongkirs.index') }}">Ongkir</a></li>
                </ul>
            </li>
            
            
            @endif
                @guest
                
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
                <a id="{{ auth()->user() && auth()->user()->role === 'admin' ? 'penjualanMenu' : '' }}"  class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Penjualan
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li><a class="dropdown-item" href="{{ route('laporan.index') }}" >Rekap Penjualan</a></li>
                        <li><a class="dropdown-item" href="{{ route('detailpenjualan.index') }}" >Detail Penjualan</a></li>
                </ul>
            </li>
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
    <div class="row mt-5"></div>
    <div class="container">
    
        @if(session('success'))
            <div class="alert alert-success mt-3">
            <div class="row"></div>
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
// Fungsi untuk memperbarui teks atau menambahkan tanda visual
function updateNotificationStatus(newOrderCount) {
        // Pilih elemen menu berdasarkan ID
        var penjualanMenu = document.getElementById('penjualanMenu');

        // Perbarui teks atau tambahkan tanda visual
        if (newOrderCount > 0) {
            penjualanMenu.innerHTML = 'Penjualan <span class="badge bg-danger">' + newOrderCount + '</span>';
        } else {
            penjualanMenu.innerHTML = 'Penjualan';
        }
    }

    // Panggil fungsi untuk mendapatkan jumlah status order baru dari backend
    // Gunakan AJAX atau metode lain untuk mengambil data dari rute atau skrip backend
    function fetchNewOrderCount() {
        // Misalnya, menggunakan Fetch API
        fetch('/get-new-order-count')  // Ganti dengan URL rute atau skrip Anda
            .then(response => response.json())
            .then(data => {
                // Panggil fungsi update dengan jumlah yang diterima dari backend
                updateNotificationStatus(data.newOrderCount);
            })
            .catch(error => {
                console.error('Error fetching new order count:', error);
            });
    }

    // Panggil fungsi fetchNewOrderCount secara berkala (misalnya, setiap beberapa detik)
    setInterval(fetchNewOrderCount, 500); 

    
$(document).ready(function() {
    

    $('#editButton').on('click', function() {
        console.log("Ini adalah pesan teks.");
});



        $('#simpanSemua').on('click', function() {

            
            var updates = []; // Array untuk menyimpan perubahan quantity

            // Loop melalui semua input quantity
            $('.quantity-input').each(function() {
                var itemID = $(this).data('item-id');
                var newQuantity = $(this).val();


                // Menambahkan perubahan ke dalam array updates
                updates.push({
                    itemID: itemID,
                    newQuantity: newQuantity
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
                        row.remove();
                    });

                    
            $('#select2User').select2({
                ajax: {
                    url: '{{ route("tes1") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(user) {
                                return {
                                    id: user.id,
                                    text: user.name,
                                    email: user.email // Menambahkan atribut email di sini
                                };
                            })
                        };
                    },
                    minimumInputLength: 3,
                    cache: true
                },
                placeholder: 'cash',
                allowClear: true
            });
        });



$(document).ready(function() {
 
var nurut = 1;
        $('#select2item').select2({
                        ajax: {
                            url: '{{ route("product.select2item") }}',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    query: params.term
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(products) {
                                        return {
                                            id: products.id,
                                            text: products.name,
                                            price: products.price
                                        
                                        };
                                    })
                                };
                            },
                            minimumInputLength: 3,
                            cache: true
                        },
                        placeholder: 'Cari item lagi',
                        allowClear: true
                    });


                    $('#plus').on('click', function(e) {
            calculateSubtotal(); // Hitung subtotal setelah menambah jumlah
       
    });

                   // Event handler untuk memeriksa dan menambahkan quantity jika item sudah ada
                   
$('#select2item').on('select2:select', function(e) {
    var data = e.params.data;

    // Mengosongkan nilai yang dipilih
    $('#select2item').val(null).trigger('change');

 
        // Item belum ada, tambahkan item ke dalam tabel seperti yang Anda lakukan sebelumnya
        var newRow = '<tr><td>' + nurut++ + '</td><td>' + data.id + '</td><td>' + data.text + '</td><td><input type="number" class="quantity-input" style="width:40px;" value="1"></td><td><select class="satuan-select"></select></td><td class="data-price">' + data.price + '</td><td class="subtotal" data-price="' + data.price + '" >' + data.price + '</td><td><button class="hapus-item">Hapus</button></td></tr>';
        $('#selecteditemTable tbody').append(newRow);

        // Mengambil data satuan dari server (misalnya melalui permintaan Ajax)
        $.ajax({
            url: '/get-satuan/' + data.id, // Ganti dengan URL yang sesuai
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var satuanDropdown = $('#selecteditemTable tbody tr:last .satuan-select'); // Mengambil dropdown satuan terkait dalam baris terakhir

                // Menambahkan opsi satuan ke dalam dropdown satuan
                $.each(response.satuan, function(index, satuan) {
                    if (satuan.name.trim() !== "") { // Memeriksa jika nama satuan bukan string kosong
                        satuanDropdown.append($('<option>', {
                            value: satuan.id, // Menggunakan ID price sebagai value
                            text: satuan.name, // Nama satuan
                        }));
                    }
                });

                // Menghitung subtotal saat item ditambahkan
                calculateSubtotal();
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data satuan.');
            }
        });

});


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

                    // Setelah pengguna memilih satuan dari dropdown satuan
                    $('#selecteditemTable').on('change', '.satuan-select2', function() {
                        var priceId = $(this).val(); // Mengambil satuan yang dipilih
                        var row = $(this).closest('tr'); // Mengambil baris terkait

                        

                        // Mengambil harga berdasarkan ID produk dan satuan yang dipilih (menggunakan AJAX)
                        $.ajax({
                            url: '/get-harga2/' + priceId ,
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

                        // Mengambil ongkos kirim dari input dengan id "ongkos_kirim"
                            var ongkosKirim = parseFloat($('#ongkos_kirim').val()) || 0;

                            // Menambahkan ongkos kirim ke total
                            total += ongkosKirim;

                        // Memperbarui total dengan pemisah ribuan
                         $('#totalAmount').text(formatNumber(total.toFixed(0)));
                    }
                    // Fungsi untuk memformat angka dengan pemisah ribuan
                    function formatNumber(number) {
                        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    $('select[name="desa_tujuan"]').change(function() {
                        var selectedOption = $(this).children("option:selected");
                        var ongkosKirim = selectedOption.data('ongkos');
                        $('#ongkos_kirim').val(ongkosKirim);
                        calculateSubtotal();
                    });


                    
                });
  
        

                $(document).ready(function() {
                    


                    $('#okSimpan').click(function() {

                        
                 // Mendapatkan elemen input tanggal
                    var inputTanggal = document.getElementById('testanggal');

                    // Mendapatkan tanggal hari ini dalam format "yyyy-MM-dd"
                    var tanggalHariIni = new Date().toISOString().slice(0, 10);

                    // Mengatur nilai default input tanggal jika tidak diisi
                    inputTanggal.value = tanggalHariIni;

                    // Menambahkan event listener untuk memeriksa perubahan pada input tanggal
                    inputTanggal.addEventListener('change', function() {
                        // Mendapatkan tanggal yang dipilih oleh pengguna
                        var tanggalDipilih = inputTanggal.value;

                        // Jika input tidak diisi, atur nilai ke tanggal hari ini
                        if (tanggalDipilih === '') {
                            inputTanggal.value = tanggalHariIni;
                        }
                    });
                        // Mendapatkan token CSRF
                        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        // Mendapatkan data pelanggan
                        var customerName = $('#select2User').val();
                        var tanggalInput = $('#testanggal').val();

                        // Periksa jika customerName kosong atau null, maka setelnya sebagai "Customer Cash"
                        if (!customerName) {
                            alert('Silakan pilih pelanggan terlebih dahulu.');
                             return; // Hentikan proses simpan
                        }

                        var dataToSave = [];

                         // Mendapatkan tanggal dari input "tanggal"
                        
                        
                        $('#selecteditemTable tbody tr').each(function() {
                            // Mendapatkan data item barang (produk) dari tabel
                            var row = $(this);
                            var kodeProduk = row.find('td:eq(1)').text(); // Ganti angka 1 dengan indeks kolom yang sesuai
                            var harga = row.find('td:eq(5)').text(); // Ganti angka 3 dengan indeks kolom yang sesuai
                            var quantity = row.find('td:eq(3) input').val(); // Ambil nilai dari input jumlah (quantity)
                            var unit = row.find('td:eq(4) select').val();


                            dataToSave.push({
                                kode_produk: kodeProduk,
                                harga: harga,
                                quantity: quantity,
                                unit: unit
                            });
                        });

                        // Menonaktifkan tombol "Simpan" untuk mencegah pengiriman ganda
                       $('#okSimpan').prop('disabled', true);

                        // Mengirim data pelanggan dan data item barang (produk) menggunakan AJAX
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("store.item") }}', // Gantilah dengan URL controller yang sesuai
                            data: {
                                _token: csrfToken, // Menyertakan token CSRF
                                customer_name: customerName,
                                tanggal: tanggalInput, // Mengirim tanggal
                                data_to_save: dataToSave
                            },
                            success: function(response) {
                                // Penanganan respons jika berhasil
                                console.log(response);

                                // Menghapus semua baris dalam tabel
                                $('#selecteditemTable tbody').empty();

                                // Mengosongkan total
                                $('#totalAmount').text('0.00');

                                // Mengarahkan pengguna ke halaman baru
                                window.location.href = '{{ route("laporan.index") }}'; // Gantilah dengan URL halaman baru
                            },
                            error: function(error) {
                                // Penanganan kesalahan jika terjadi
                                console.error(error);

                                // Mengaktifkan kembali tombol "Simpan" jika ada kesalahan
                                $('#okSimpan').prop('disabled', false);
                            }
                        });
                    });

                    
                    

                });

    </script>


</body>
</html>