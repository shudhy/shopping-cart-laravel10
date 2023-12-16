@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Show Ongkir
                </div>
                <div class="card-body">
                <form action="{{ route('ongkirs.update', $ongkir->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-bold">Desa Asal</label>
                        <input type="text" class="form-control" name="dasal" value="{{$ongkir->desa_asal}}" >
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Desa Tujuan</label>
                        <input type="text" class="form-control" name="dtuju" value="{{$ongkir->desa_tujuan}}" >
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Biaya</label>
                        <input type="number" class="form-control" name="biaya" value="{{$ongkir->biaya}}" >
                    </div>
                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                    <a href="{{ route('ongkirs.index') }}" class="btn btn-md btn-primary">Kembali</a>

                </div>
            </div>

                        
                
            </div>
   
   
    
@endsection
