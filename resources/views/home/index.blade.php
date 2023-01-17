@extends('home.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <div class="mb-2">
    <div>
    <form action="{{ route('home.index') }}" method="GET">
    
    <table class="table table-bordered">
        <tr>
             <th>Poza</th>
            <th>Nume</th>
            <th>Descriere</th>
            <th>Status</th>
            <th>Pret</th>
         
            <th> CodProdus </th>
        </tr>
        @foreach ($verificare as $item)
        <tr>
           
            <td><img src="/poza/{{ $item->poza }}" width="100px"></td>
            <td>{{ $item->nume }}</td>
            <td>{{ $item->descriere }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->pret }}</td>
            <td>{{ $item->codprodus }}</td>
</form>
</div>

 
@endforeach