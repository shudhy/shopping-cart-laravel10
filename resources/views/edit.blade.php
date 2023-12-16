@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
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
                                <label class="font-weight-bold">satuan 1</label>
                                <input type="text" class="form-control" name="satuan1" value="{{  isset($prices[0]) ? $prices[0]->unit->name : old('satuan1') }}" placeholder="Masukkan Satuan 1">
                                <input type="hidden" name="idunit1" value="{{$prices[0]->unit->id}}">
                                <input type="hidden" name="idunit2" value="{{$prices[1]->unit->id}}">
                                <input type="hidden" name="idunit3" value="{{$prices[2]->unit->id}}">

                            
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 2</label>
                                <input type="text" class="form-control" name="satuan2" value="{{ isset($prices[1]) ? $prices[1]->unit->name : old('satuan2') }}" placeholder="Masukkan satuan 2">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 3</label>
                                <input type="text" class="form-control" name="satuan3" value="{{ isset($prices[2]) ? $prices[2]->unit->name : old('satuan3') }}" placeholder="Masukkan satuan 3">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga 1</label>
                                <input type="number" class="form-control" name="harga1" value="{{ isset($prices[0]) ? $prices[0]->price : old('harga1') }}" placeholder="Masukkan harga 1">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga 2</label>
                                <input type="number" class="form-control" name="harga2" value="{{ isset($prices[1]) ? $prices[1]->price : old('harga2') }}" placeholder="Masukkan harga 2">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga 3</label>
                                <input type="number" class="form-control" name="harga3" value="{{ isset($prices[2]) ? $prices[2]->price : old('harga3') }}" placeholder="Masukkan harga 3">
                            </div>

                            <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="aktif" {{ $product->status === 'aktif' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="tidak aktif" {{ $product->status === 'tidak aktif' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Tidak Aktif</label>
                            </div>
                        </div>





                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('itemx') }}" class="btn btn-md btn-primary">Kembali</a>

                        </form> 
                </div>
            </div>

                        
                
            </div>
       
   
   
    
@endsection
