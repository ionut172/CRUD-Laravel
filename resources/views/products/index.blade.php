@extends('products.layout')
     
@section('content')
   


<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Laravel </h2>
            </div>
            <div>
                
        <div class="mx-auto pull-right">
            <div class="">
                
                        <a href="{{ route('products.index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <div>
                                <a href="{{ $product}}?sort=DESC" style="color:black"> Ordoneaza de la Z-A<br></a>
                                <a href="{{ $product}}?sort=ASC" style="color:black"> Ordoneaza de la A-Z<br> </A>
                                <a href="{{ $product}}?sort=DESC" style="color:black"> High to low<br></a> 
                                <a href="{{ $product}}?sort=ASC" style="color:black"> Low to high</a> |
                                <div>
                                    
                                <form action="{{ route('products.index') }}" method="GET">
                                    <br> </br>
    <input type="text" name="min_price">   //Minim
    <br> </br>
    <input type="text" name="max_price">  //Maxim
    <br> </br>
    <input type="submit" value="Filter">
</form>

                          
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}">Adauga produs</a>
            </div>
        </div>
      
        <form action="{{route('products.index')}}" method="GET">
   
</form>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
             <th>Poza</th>
            <th>Nume</th>
            <th>Descriere</th>
            <th>Status</th>
            <th>Pret</th>
            <th width="280px">Action</th>
            <th> CodProdus </th>
        </tr>
        @foreach ($product as $item)
        <tr>
           
            <td><img src="/poza/{{ $item->poza }}" width="100px"></td>
            <td>{{ $item->nume }}</td>
            <td>{{ $item->descriere }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->pret }}</td>

            <td>
                <form action="{{ route('products.destroy',$item->codprodus) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('products.show',$item->codprodus) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('products.edit',$item->codprodus) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            <td>{{ $item->codprodus }}</td>
        </tr>
        @endforeach
    </table>
    
    {!! $product->links() !!}
        
@endsection

<div>
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('products.index') }}" method="GET" role="search">

                   
                        <input type="text" class="form-control mr-2" name="term" placeholder="Cauta in produse" id="term">
                        <a href="{{ route('products.index') }}" class=" mt-1">
                            
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>