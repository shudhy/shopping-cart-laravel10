@extends('auth.layouts')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Edit Item
                </div>
                <div class="card-body">
                <form action="{{ route('item.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <img src="{{ asset('storage/images/'.$product->image) }}" class="w-100 rounded">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select name="kategori" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Kategori</option>
                                    @foreach($kategori as $item)
                                    <option value="{{ $item->id }}"@if($item->id == $product->id_kategori) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description</label>
                                <textarea class="form-control" name="desc" rows="5">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}" >
                            </div>


                            
                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('itemx') }}" class="btn btn-md btn-primary">Kembali</a>

                        </form> 
                </div>
            </div>

                        
                
            </div>
        </div>
   
   
    
@endsection
