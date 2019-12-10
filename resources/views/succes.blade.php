@extends('layouts.master')

@section('content')
     <div class="row">
            <div class="col-md-12">
                <div class='alert alert-info'>
                    <p style='text-align: center; color: black;'>Factuur gemaakt met factuurnummer {{$factuurID}}<br>
                    <a style='text-align: center; ' href='{{route('autozooi.factuur', ['id' => $factuurID])}}'target="_blank">Klik hier om de factuur te bekijken</a></p>
                </div>
            </div>
        </div>
@endsection