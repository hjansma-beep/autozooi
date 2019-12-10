@extends('layouts.master')

@section('content')
 @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p style='color:red;' class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
@endif
                <script type='text/javascript'> 
function submitForm(){ 
  // Call submit() method on <form id='myform'>
  document.getElementById('form').submit(); 
} 
</script>
@if(Session::has('lijst'))

@if(!Session::get('customer'))
<p id = 'zoekKlant'>Zoek een klant voor de factuur op klantnummer of bedrijfsnaam:</p>
<form method='POST' action = {{route('autozooi.test')}}>
    @csrf
    <div class="input-group" id="zoekbalk">
        <input type="text" class="form-control" name="q"
            placeholder="Zoek op klantnr. of bedr.naam"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span style='height: 20px;' class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
        {{-- <input type='text' name='q' >
        <button type='submit' name='submit'>Search</button><br><br> --}}
</form>
@endif

  @if(Session::get('customer'))
    <h4>Factuur maken voor:<a style='float: right; font-size: 14px; padding-right: 450px; padding-top: 2px; text-decoration: underline;' href={{route('autozooi.wijzigKlant')}}>Wijzig klant</a></h4>
    <div>Klantnummer: {{Session::get('customer')['klantnummer']}}<br> 
         Bedrijfsnaam: {{Session::get('customer')['bedrijf']}}<br>
         Adres: {{Session::get('customer')['adres'] . ', ' . Session::get('customer')['postcode'] . ', ' . Session::get('customer')['plaats']}}
    </div>
  @endif
   
  @if(Session::get('klanten'))
        @foreach(Session::get('klanten') as $klant)
            <div>{{$klant['klantnummer'] . ' | ' . $klant['bedrijf'] . ' | ' . $klant['adres'] . ', ' . $klant['postcode'] . ', ' . $klant['plaats']}}<a href="{{ route('autozooi.klantSelect', ['id' => $klant->klantnummer]) }}"> Gebruik voor factuur</a></div>
        @endforeach
    {{ Session::forget('klanten')}}
    @endif  
    <hr id='lijn'> 
        <table class='table table-striped table-bordered mydatatable'>
                <thead>
                    <tr>
                        <th>Omschrijving</th>
                        <th>Aantal</th>
                        <th>Prijs</th>
                        <th></th>
                    </tr>
                </thead>
                    @foreach($products as $product)
                     <tbody>
                    <tr>
                        <td>{{ $product['item']['omschrijving'] }}</td>
                        <td><form method='POST' id='form' name='form'>
                        @csrf
                        <input onchange='submitForm();' name="qty[{{ $product['item']['artikelnummer'] }}]" style='width: 40px;' value={{ $product['qty'] }} ></td>
                        <td>€{{ number_format($product['price'], 2,',','.') }}</td>
                        <input type='hidden' name="price[{{ $product['item']['artikelnummer'] }}]" value={{ $product['price'] }}>
                        <input type='hidden' name="artikelnr[{{ $product['item']['artikelnummer']}}]" value= {{$product['item']['artikelnummer']}}>
                        <td style='width: 100px;'><a style='background: red;' href={{ route('product.remove', ['id' => $product['item']['artikelnummer']]) }}
                                   class="btn btn-success center" role="button">verwijderen</a></td>
                    </tr>
                    @endforeach
                    <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Totaal excl BTW.</td>
                    <td colspan='2' class="subtotal">€{{ number_format($subtotal, 2,',','.') }}</td>
                    </tr>
                      <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">BTW 5%</td>
                    <td colspan='2' class="total">€{{ number_format($BTW, 2,',','.') }}</td>
                    </tr>
                     <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Totaal</td>
                    <td colspan='2' class="total">€{{ number_format($total, 2,',','.') }}</td>
                    </tr>
                    </tbody>
                </table>
                 {{-- <button style='float:right;' type='submit' name='submit'>Bereken totalen</button><br><br> --}}
                 <button style='background: blue;' class="btn btn-success center" type="submit" formaction={{ route('autozooi.factuur') }}>Factuur maken</button></form>

    @else
        <div class="row" >
            <div class="col-md-12" id="zoekbalk">
                <p class="alert alert-info" id="info">U heeft nog geen artikelen toegevoegd.</p>
            </div>
        </div>
    @endif

@endsection
<script type='text/javascript'> 
function submitForm(){
    document.getElementById('form').submit();
}
</script>


 