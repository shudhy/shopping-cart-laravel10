@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Tambah Ongkir
                </div>
                <div class="card-body">
                <form action="{{ route('ongkirs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Desa Asal</label>
                                <input type="text" class="form-control" name="dasal" value="{{ old('dasal') }}" placeholder="Masukkan Nama Desa asal">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Desa Tujuan</label>
                                <input type="text" class="form-control" name="dtuju" value="{{ old('dtuju') }}" placeholder="Masukkan Nama Desa Tujuan">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Biaya</label>
                                <input type="number" class="form-control" name="biaya" value="{{ old('biaya') }}" placeholder="Masukkan Biaya">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary ">Simpan</button>

                </form> 
                </div>
            </div>

                        
                
            </div>
   
   
    
@endsection
