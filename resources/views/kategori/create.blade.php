@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Tambah Kategori
                </div>
                <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Kategori">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary ">Simpan</button>

                </form> 
                </div>
            </div>

                        
                
            </div>
   
   
    
@endsection
