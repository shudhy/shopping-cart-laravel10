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
                            New Penjualan
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label class="col-form-label font-weight-bold">No Penjualan :</label>
                                </div>
                                <div class="col-auto">
                                <input type="number" class="form-control form-control-sm" id="nopenjualan" placeholder="Auto" readonly>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label class="col-form-label font-weight-bold">Tgl Penjualan  :</label>
                                </div>
                                <div class="col-auto">
                                <input type="date" class="form-control form-control-sm" id="testanggal">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Pelanggan :</label>
                                <select id="select2User" style="width: 30%;">
                                <!-- Opsi pengguna akan dimasukkan di sini secara dinamis -->
                            </select>
                            </div>
                    </div>
            </div>

        </div>
        <table class="table table-hover" id="selecteditemTable">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">kode produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">satuan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">SubTotal</th>
                    
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
                </table>
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="text-align: center;"><strong>Total:</strong> <strong id="totalAmount">0</strong></div>
                </div>
                <div class="form-group">
                    <select id="select2item" style="width: 20%;">
                        
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12"><button  id="okSimpan" class="btn btn-primary">Simpan</button></div>
                </div>
                
    </div>    
</div>
    
@endsection
