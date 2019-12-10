@extends('layouts.master')
@section('content')

 @if(Session::has('info'))
        <div class="row" >
            <div class="col-md-12" id="zoekbalk">
                <p class="alert alert-info" id="info">{{ Session::get('info') }}</p>
            </div>
        </div>
@endif
<h4 id='zoekKlant' >Zoek artikelen voor de factuur:</h4>
<form action={{ route('autozooi.zoek') }} method="get">
    @csrf
    <div class="input-group" id="zoekbalk" >
        <input type="text" class="form-control" name="q"
            placeholder="Zoek op artikelnaam"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>

@if(isset($parts))

<p id='resultFound'>{{ $results }} resultaten gevonden voor '{{ $q }}'</p>

<table class='table table-striped table-bordered mydatatable'>
    <thead>
        <tr>
            <th>Artikelnummer</th>
            <th>Artikelgroep</th>
            <th>Omschrijving</th>
            <th style='width: 60px;'>Prijs
            @if(isset($setAsc))
            <a style= 'font-size: 15px;'href={{ route('autozooi.zoek', ['q' => $q]) }}> ^</a> 
            @else
            <a style='font-size: 12px;' href={{ route('autozooi.zoek', ['q' => $q, 'desc' => 1]) }}> v</a>
            @endif
            </th>
            <th></th>
        </tr>
    </thead>
@foreach($parts as $part)
        <tbody>
            <tr>
                <td>{{ $part->artikelnummer }}</td>
                <td>{{ $part->artikelgroep }}</td>
                <td>{{ $part->omschrijving }}</td>
                <td>{{ number_format($part->prijs, 2, ',', ' ') }}</td>
                 <td><a href="{{ route('product.addToLijst', ['id' => $part->artikelnummer]) }}"
                                   class="btn btn-success center" role="button">Aan Factuur
                                   toevoegen</a></td>
            </tr>
        </tbody>
@endforeach
</table>
<div id='pagination'>
    {{ $parts->links() }}
</div>
@endif 
@endsection