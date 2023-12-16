@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Edit Kategori
                </div>
                <div class="card-body">
                        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ $kategori->nama }}">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary">Kembali</a>
                            </div>
                        </form> 

                </div>
            </div>
        </div>
   
   
    
@endsection
