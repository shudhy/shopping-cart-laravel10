@extends('auth.layouts')

@section('content')
        <div class="row mt-5">
            <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Show Item
                </div>
                <div class="card-body">
                    
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar</label>
                                <img src="{{ asset('storage/images/'.$product->image) }}" class="w-100 rounded">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                                <select name="kategori" class="form-select" aria-label="Default select example" readonly>
                                    <option selected>Pilih Kategori</option>
                                    @foreach($kategori as $item)
                                    <option value="{{ $item->id }}"@if($item->id == $product->id_kategori) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Description</label>
                                <textarea class="form-control" name="desc" rows="5" readonly>{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 1</label>
                                <input type="text" class="form-control" name="satuan1" value="{{  isset($prices[0]) ? $prices[0]->unit->name : old('satuan1') }}"  readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 2</label>
                                <input type="text" class="form-control" name="satuan2" value="{{ isset($prices[1]) ? $prices[1]->unit->name : old('satuan2') }}"  readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">satuan 3</label>
                                <input type="text" class="form-control" name="satuan3" value="{{ isset($prices[2]) ? $prices[2]->unit->name : old('satuan3') }}"  readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga 1</label>
                                <input type="number" class="form-control" name="harga1" value="{{ isset($prices[0]) ? number_format( $prices[0]->price, 0, ',', '.') : old('harga1') }}" placeholder="Masukkan harga 1" readonly>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga 2</label>
                                <input type="number" class="form-control" name="harga2" value="{{ isset($prices[1]) ? number_format( $prices[1]->price, 0, ',', '.') : old('harga2') }}" placeholder="Masukkan harga 2" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga 3</label>
                                <input type="number" class="form-control" name="harga3" value="{{ isset($prices[2]) ? number_format( $prices[2]->price, 0, ',', '.') : old('harga3') }}" placeholder="Masukkan harga 3" readonly>
                            </div>

                            <a href="{{ route('itemx') }}" class="btn btn-md btn-primary">Kembali</a>

                        </form> 
                </div>
            </div>

                        
                
            </div>
   
   
    
@endsection
