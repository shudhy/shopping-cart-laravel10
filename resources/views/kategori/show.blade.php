@extends('auth.layouts')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Show Kategori
                </div>
                <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{$kategori->nama}}" readonly>
                            </div>

                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-primary">Kembali</a>

                </div>
            </div>

                        
                
            </div>
        </div>
   
   
    
@endsection
