@extends('shop')
   
@section('content')
<div class="row mt-4 mb-4">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img  src="/images/image1.jpg" class="img-fluid" alt="...">
            </div>
            <div class="carousel-item">
            <img src="/images/image2.jpg" class="img-fluid"  alt="...">
            </div>
            <div class="carousel-item">
            <img src="/images/image3.jpg" class="img-fluid"  alt="...">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
<div class="col-md-4">
    <form action="{{ route('products.searchh') }}" method="GET">
    
        <div class="input-group mb-3">
            <input type="text" name="query" class="form-control" placeholder="Search by nama, kode, or kategori" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
    </div>
</div>
<div class="row">
    
    @foreach($products as $product)
        <div class="col-md-2 col-6 mb-3">
            <div class="card">
                <div class="card-body"> 
                <a href="#" data-toggle="modal" data-target="#myModal{{ $product->id }}"><img class="img-fluid" src="/storage/images/{{ $product->image }}" alt="Gambar Produk"> </a>
               
                    <h6 class="card-title">{{ substr($product->name, 0, 21) }}</h6>
                    @php
                        $harga = $product->price;
                    @endphp
                    <p class="card-text"><strong>Rp.{{ number_format($harga, 0, ',', '.') }}</strong></p>
                    <p class="btn-holder"><a href="{{ route('addProduct.to.cart', $product->id) }}" class="btn btn-warning" >Beli</a> </p>
                    

                            <div class="modal fade" id="myModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{ $product->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                <img class="img-fluid" src="/storage/images/{{ $product->image }}" alt="Gambar Produk">
                                <div class="modal-header">
                                
                                    <h4 class="modal-title">{{ $product->name }}</h4>
                                </div>
                                <div class="modal-body">
                                    <p>{{ strip_tags( $product->description) }}</p>
                                    
                                    <p class="card-text"><strong>Rp.{{ number_format($harga, 0, ',', '.') }}</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                                </div>
                            </div>
                            </div>


                </div>
            </div>
        </div>
    @endforeach         
    {{ $products->links('vendor.pagination.default') }}     
</div>


    
@endsection