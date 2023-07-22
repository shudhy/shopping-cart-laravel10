@extends('auth.layouts')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Tambah Item
                </div>
                <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Produk">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select name="kategori" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Kategori</option>
                                    @foreach($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description</label>
                                <textarea class="form-control" name="desc" rows="5" placeholder="Masukkan Description">{{ old('desc') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="number" class="form-control" name="price" value="{{ old('price') }}" placeholder="Masukkan Harga">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>

                        </form> 
                </div>
            </div>

                        
                
            </div>
        </div>
   
   
    
@endsection
