<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ url('css/factuur.css') }}" media="all" />
  </head>
  <body>
    <header class="clearfix">
     {{--  <div id="logo">
        <img src="logo.png">
      </div> --}}
      @if(isset($PDF))
        <a href={{ url('generate-pdf')}}><img src="{{url('/img/pdf-icon.png')}}" alt="Image"/></a>
      @endif
      <h1>Factuur</h1>
      <div id="company" @if(isset($PDF)) style='padding-right: 80px;'@endif>
        <div>Autozooi</div>
        <div>Laan 12,<br /> 1234 AB, Verweg</div>
        <div>E: autozooibv@gmail.com</div>
        <div>T: 06-12345567</div>
        <div>IBAN: NL68 ABNA 087875795</div>
        <div>KvK nr.: 70251478</div>
        <div>BTW nr.: 23658751801</div>
      </div>
      <div>
        <div>{{ $customer->bedrijf }}</div>
        <div>Afdeling Crediteuren</div>
        <div>{{ $customer->adres }}</div>
        <div>{{ $customer->postcode . ' ' . $customer->plaats }}</div><br>
        <div class='factuur'>Factuur:</div>
    <div>Factuurnummer: {{str_pad($factuurID, 8, "0", STR_PAD_LEFT)}}</div>
    <div>Factuurdatum: {{ $datum }}</div>
      </div>
     </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Artikelnummer</th>
            <th>Omschrijving</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Totaal</th>
          </tr>
        </thead>
        @foreach($products as $product)
        <tbody>
          <tr>
            <td>{{ trim($product['item']['artikelnummer']) }}</td>
            <td>{{ $product['item']['omschrijving'] }}</td>
            <td>€{{ number_format($product['item']['prijs'], 2, ',', ' ') }}</td>
            <td>{{ $product['qty'] }}</td>
            <td>€{{  number_format($product['price'], 2, ',', '.') }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4" class='subtotal'>Subtotaal</td>
            <td class="total">€{{ number_format($subtotal, 2 , ',', '.') }}</td>
          </tr>
          <tr>
            <td colspan="4" class='subtotal'>BTW 5%</td>
            <td class="total">€{{ number_format($BTW, 2 , ',', '.') }}</td>
          </tr>
          <tr>
            <td colspan="4" class="grandtotal">Totaal incl. BTW</td>
            <td class="grandtotalSum">€{{ number_format($total, 2 , ',', '.') }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div class="notice">
        <br>
        Wij verzoeken u vriendelijk bovenstaand bedrag binnen 30 dagen over te maken op IBAN: NL68 ABNA 087875795 t.n.v. onderdelen BV onder vermelding van factuurnummer {{str_pad($factuurID, 8, "0", STR_PAD_LEFT)}}</div>
      </div>
    </main>
    <footer>
      Deze factuur is gemaakt op een computer en geldig zonder handtekening en zegel.
    </footer>
  </body>
</html>
