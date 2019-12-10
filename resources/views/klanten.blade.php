@extends('layouts.master')

@section('content')
    <table class='table table-striped table-bordered mydatatable'>
    <thead>
        <tr>
            <th>Klantnummer</th>
            <th>Bedrijfsnaam</th>
            <th>Adres</th>
        </tr>
    </thead>
        @foreach ($klanten as $klant)
            <tbody>
                <tr>
                    <td>{{ $klant->klantnummer }}</td>
                    <td>{{ $klant->bedrijf }}</td>
                    <td>{{ $klant->postcode . ', ' . $klant->adres . ', ' . $klant->plaats }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
<div id='pagination'>
    {{ $klanten->links() }}
</div>
@endsection
