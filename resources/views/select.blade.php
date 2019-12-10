@extends('layouts.master')

@section('content')

<table class='table table-striped table-bordered mydatatable'>
    <thead>
        <tr>
            <th>klantnummer</th>
            <th>bedrijf</th>
            <th>adres</th>
            <th></th>
        </tr>
    </thead>
@foreach($klanten as $klant)
    <tbody>
        <tr>
            <td>{{$klant['klantnummer']}}</td>
            <td>{{$klant['bedrijf']}}</td>
            <td>{{$klant['adres'] . ',' . $klant['postcode'] . ',' . $klant['plaats']}}</td>
            <td><a href="{{ route('autozooi.test', ['id' => $klant->klantnummer]) }}"
                                   class="btn btn-success center" role="button">Aan Factuur
                                   toevoegen</a></td>
        </tr>
    </tbody>
@endforeach

@endsection