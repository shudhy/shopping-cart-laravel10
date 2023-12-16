@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Show Ongkir
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Desa Asal</label>
                        <input type="text" class="form-control" name="dasal" value="{{$ongkir->desa_asal}}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Desa Tujuan</label>
                        <input type="text" class="form-control" name="dtuju" value="{{$ongkir->desa_tujuan}}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Biaya</label>
                        <input type="number" class="form-control" name="biaya" value="{{$ongkir->biaya}}" readonly>
                    </div>

                    <a href="{{ route('ongkirs.index') }}" class="btn btn-md btn-primary">Kembali</a>

                </div>
            </div>

                        
                
            </div>
   
   
    
@endsection
