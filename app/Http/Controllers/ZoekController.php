<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Part;
use App\Lijst;
use App\Customer;
use Session;
use Carbon\Carbon;
use App\Invoice;
use App\Product;
use DB;

class ZoekController extends Controller
{
    public function GetZoeken()
    {
        return view('zoeken');
    }
    public function PostZoeken(Request $request)
    {
        if($request->get('desc')) {
            $q = $request->get('q');
            $parts = Part::where('omschrijving','LIKE','%'.$q.'%')->orderBy('prijs', 'desc')->paginate(10);
            return view('zoeken',['parts' => $parts->appends(Input::except('page')), 'results'=> $parts->total(), 'q' => $q, 'setAsc' => 1]);
            }
         else {
        if($request->get('q')) {
        $q = $request->get('q');
        $parts = Part::where('omschrijving','LIKE','%'.$q.'%')->orderBy('prijs', 'asc')->paginate(10);
        return view('zoeken',['parts' => $parts->appends(Input::except('page')), 'results'=> $parts->total(), 'q' => $q]);
        }
        else {
            return view('zoeken');
        }  
    } 
    }
    public function getAddToLijst(Request $request, $id)
    {
        $product = Part::where('artikelnummer', $id)->first();
        echo $product->omschrijving;
        $oldLijst = Session::has('lijst') ? Session::get('lijst') : null;
        $lijst = new Lijst($oldLijst);
        $lijst->add($product, trim($product->artikelnummer));
        $request->session()->put('lijst', $lijst);
        return redirect()->route('autozooi.zoek')->with('info', $product->omschrijving . 'toegevoegd aan factuur');  
    }
        public function getLijst()
    {
        if (!Session::has('lijst')) {
            return view('lijst');
        }
        $oldLijst = Session::get('lijst');
        $lijst = new Lijst($oldLijst);
        $subtotal = $lijst->totalPrice;
        $BTW = $subtotal / 100 * 5;
        $total = $subtotal + $BTW;
        return view('lijst', ['products' => $lijst->items, 'subtotal' => $subtotal, 'total' => number_format($total, 2, '.', ''), 'BTW' => number_format($BTW, 2, '.', '')]);
    }
    public function getRemoveItem($id) {
        $oldLijst = Session::has('lijst') ? Session::get('lijst') : null;
        $lijst = new Lijst($oldLijst);
        $lijst->removeItem($id);
        if (count($lijst->items) > 0) {
            Session::put('lijst', $lijst);
        } else {
            Session::forget('lijst');
        }
        return redirect()->route('autozooi.lijst');
    }
    public function getRemoveFactuur($id) {
        DB::table('invoices')->where('ID', $id)->delete();
        return redirect()->route('autozooi.facturen')->with('info', 'Factuur verwijderd');
    }
    public function postLijst(Request $request)
    {
        // dd($request);
        $id = $request->get('artikelnr');
        $array1 = [];
        foreach($id as $item=>$key) {
            array_push($array1, $key);
        }
        $newQty = $request->get('qty');
        $array2 = [];
        foreach($newQty as $item=>$key) {
            array_push($array2, $key);
        }
        $array3 = array_combine($array1, $array2);
        $oldLijst = Session::get('lijst');
        $lijst = new Lijst($oldLijst);
        $totalsArray = [];
        foreach($array3 as $id=>$qty) {
            $product = Part::where('artikelnummer', $id)->first();
            $lijst->items[$id]['qty'] = $qty;
            $lijst->items[$id]['price'] = number_format(($product->prijs * $qty), 2, '.', '');
            array_push($totalsArray ,$lijst->items[$id]['price']);
            };
        $lijst->totalPrice = number_format((array_sum($totalsArray)), 2 , '.' , '');
        $request->session()->put('lijst', $lijst);
        return redirect()->route('autozooi.lijst');
    }
    public function getFactuur(Request $request)
    {
        $id = $request->get('id');
        Session::put('factuur_id', $id);
        $factuur = Invoice::where('ID',$id)->first();
        $datum = Carbon::parse($factuur['factuurdatum'])->format('d/m/Y');
        $klantnummer = $factuur['klantnummer'];
        $aantallen = unserialize($factuur['aantallen']);
        $prijzen = unserialize($factuur['prijzen']);
        $artikelnummers = unserialize($factuur['artikelnummers']);
        // dd($artikelnummers);
        $customer = Customer::where("klantnummer", $klantnummer)->first();
        // dd($customer);
        $product = new Product();
        foreach($artikelnummers as $key=>$value) {
                $product->add($aantallen[$key][0], $prijzen[$key][0], Part::where('artikelnummer', $key)->first(), $key); 
            }
            $subtotal = $product->totalPrice;
            $BTW = $subtotal / 100 * 5;
            $total = $subtotal + $BTW;
            $PDF = 1;
        return view('factuur',['products' => $product->items, 'factuurID' => $id, 'customer' => $customer, 'subtotal' => $subtotal, 'BTW' => $BTW, 'total' => $total, 'PDF' => $PDF, 'datum' => $datum]);
    }
    public function postFactuur(Request $request)
    {
        $klantnummer = Session::get('customer')['klantnummer']; 
        if(isset($klantnummer)) {
        $factuurDatum = Carbon::now();
        $prijs = $request->get('price');
        $artikelnummer = $request->get('artikelnr');
        $quantity = $request->get('qty');
        $factuurID = DB::table('invoices')->insertGetId(
        ['factuurdatum' => $factuurDatum, 'klantnummer' => $klantnummer, 'aantallen' => serialize($quantity), 'artikelnummers' => serialize($artikelnummer), 'prijzen' => serialize($prijs)]);
        return redirect()->route('autozooi.succes',['id'=>$factuurID]);
        } else {
            return redirect()->route('autozooi.lijst')->with('info', 'Geen klant geselecteerd voor factuur');;
        }
    }
    public function postTest(Request $request)
    {
      $q = $request->get('q');
      if(!empty($q)) {
      $klanten = Customer::where('bedrijf','LIKE','%'.$q.'%') 
        ->orwhere('klantnummer',$q)->get();
      $request->session()->put('klanten', $klanten);
    //   dd($klanten[0]['bedrijf']);
      return redirect()->route('autozooi.lijst');
      } else {
        return redirect()->route('autozooi.lijst')->with('info', 'U heeft geen zoekterm ingevoerd');
      }
    }           
    public function getKlantSelect(Request $request)
    {
       $klantnummer = $request->get('id');
       $customer = Customer::where('klantnummer', $klantnummer)->first();
       Session::put('customer', $customer);
       return redirect()->route('autozooi.lijst');
    }
    public function wijzigKlant()
    {
        Session::forget('customer');
        return redirect()->route('autozooi.lijst');
    }
    public function getFacturen()
    {
        $facturen = DB::table('invoices')
            ->join('customers', 'invoices.klantnummer', '=', 'customers.klantnummer')
            ->paginate(10);
        return view('facturen',['facturen' => $facturen->appends(Input::except('page'))]);
    }
    public function getSucces(Request $request)
    {
        Session::forget('lijst');
        Session::forget('customer');
        $id = $request->get('id');
        return view('succes',['factuurID'=>$id]);
    }
    public function getKlanten()
    {
        $klanten = DB::table('customers')->orderBy('bedrijf', 'asc')->paginate(10);
        return view('klanten',['klanten' => $klanten->appends(Input::except('page'))]);
    }
}