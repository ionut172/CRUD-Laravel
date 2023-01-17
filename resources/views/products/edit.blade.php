@extends('products.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editeaza produsul</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Inapoi</a>
            </div>
        </div>
    </div>
     
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Stai!</strong> A fost gasita o eroare in datele adaugate.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('products.update',$product->codprodus) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
     
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nume:</strong>
                    <input type="text" name="nume" value="{{ $product->nume }}" class="form-control" placeholder="Nume">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Descriere:</strong>
                    <textarea class="form-control" style="height:150px" name="descriere" placeholder="Descriere">{{ $product->descriere }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Poza:</strong>
                    <input type="file" name="poza" class="form-control" placeholder="poza">
                    <img src="/image/{{ $product->poza }}" width="300px">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <textarea class="form-control" style="height:150px" name="status" placeholder="Status">{{ $product->status }}</textarea>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pret:</strong>
                    <textarea class="form-control" style="height:150px" name="pret" placeholder="Pret">{{ $product->pret }}</textarea>
                </div>
            </div>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
     
    </form>
@endsection