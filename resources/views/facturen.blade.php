@extends('layouts.master')

@section('content')
 @if(Session::has('info'))
        <div class="row" >
            <div class="col-md-12" id="zoekbalk">
                <p class="alert alert-info" id="info">{{ Session::get('info') }}</p>
            </div>
        </div>
@endif
<h4 style='text-align:center'>Alle facturen:</h4>
<table id= 'tbl' class='table table-striped table-bordered mydatatable'>
    <thead>
        <tr>
            <th>Factuurnummer</th>
            <th>klantnummer</th>
            <th>Bedrijf</th>
            <th>Datum</th>
            <th colspan='2' style='text-align:center;'>Actie:</th>
        </tr>
    </thead>
@foreach($facturen as $factuur)
        <tbody>
            <tr id='factuurlink'>
                <td>{{ str_pad($factuur->ID, 8, "0", STR_PAD_LEFT) }}</td>
                <td>{{ $factuur->klantnummer }}</td>
                <td>{{ $factuur->bedrijf }}</td>
                <td>{{ $factuur->factuurdatum }}</td>
                <td style='width: 100px;'><a target='_blank' href={{ "factuur?id=" . $factuur->ID }}
                class="btn btn-success center" role="button">bekijken</a></td>
                <td style='width: 100px;'><a style='background: red;'
                 href={{ route('autozooi.removeFactuur', ['id' => $factuur->ID]) }}
                                   class="btn btn-success center" role="button">verwijderen</a></td>
            </tr>
        </tbody>
@endforeach
</table>
<div id='pagination'>
    {{ $facturen->links() }}
</div>
@endsection