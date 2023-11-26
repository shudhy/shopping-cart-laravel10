@extends('auth.layouts')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning bg-gradient">
                    Tambah Item
                </div>
                <div class="card-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Kode</label>
                                <input type="text" class="form-control @error('id_item') is-invalid @enderror" name="id_item" value="{{ old('id_item') }}" placeholder="Masukkan ID Produk">
                                @error('id_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Produk">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example">
                                    <option selected>Pilih Kategori</option>
                                    @foreach($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description</label>
                                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" rows="5" placeholder="Masukkan Description">{{ old('desc') }}</textarea>
                                @error('desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 1</label>
                                <input type="text" class="form-control" name="satuan1" value="{{ old('satuan1', 'PCS') }}" placeholder="Masukkan Satuan 1">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 2</label>
                                <input type="text" class="form-control" name="satuan2" value="{{ old('satuan2') }}" placeholder="Masukkan satuan 2">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 3</label>
                                <input type="text" class="form-control" name="satuan3" value="{{ old('satuan3') }}" placeholder="Masukkan satuan 3">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga 1</label>
                                <input type="number" class="form-control @error('harga1') is-invalid @enderror" name="harga1" value="{{ old('harga1') }}" placeholder="Masukkan harga 1">
                                @error('harga1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga 2</label>
                                <input type="number" class="form-control" name="harga2" value="{{ old('harga2') }}" placeholder="Masukkan harga 2">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga 3</label>
                                <input type="number" class="form-control" name="harga3" value="{{ old('harga3') }}" placeholder="Masukkan harga 3">
                            </div>

                            <button type="submit" class="btn btn-md btn-primary ">Simpan</button>

                        </form> 
                </div>
            </div>

                        
                
            </div>
        </div>
   
   
    
@endsection
