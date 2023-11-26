<!DOCTYPE html>
<html>
<head>
    <title>Contoh Laravel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <!-- Konten halaman Laravel Anda -->

   

    <table id="selectedUsersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data yang dipilih akan ditampilkan di sini -->
        </tbody>
    </table>

    <select id="select2User" style="width: 100%;">
        <!-- Opsi pengguna akan dimasukkan di sini secara dinamis -->
    </select>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
         $(document).ready(function() {
            // Inisialisasi Select2
            $('#select2User').select2({
    ajax: {
        url: '{{ route("users.select2") }}',
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
    placeholder: 'Cari item lagi',
    allowClear: true
});

$('#select2User').on('select2:select', function(e) {
    var data = e.params.data;

    // Mengosongkan nilai yang dipilih
    $('#select2User').val(null).trigger('change');

    // Menambahkan data ke dalam tabel
    var newRow = '<tr><td>' + data.id + '</td><td>' + data.text + '</td><td>' + data.email + '</td></tr>';
    $('#selectedUsersTable tbody').append(newRow);
});

        });

    </script>
</body>
</html>
