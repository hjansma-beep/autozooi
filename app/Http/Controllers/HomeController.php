<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use PDF;
use Session;
use App\Lijst;
use DB;
use App\Invoice;
use App\Customer;
use App\Product;
use App\Part;
use Carbon\Carbon;
  
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        $id = Session::get('factuur_id');
        $factuur = Invoice::where('ID',$id)->first();
        $datum = Carbon::parse($factuur['factuurdatum'])->format('d/m/Y');
        $klantnummer = $factuur['klantnummer'];
        $aantallen = unserialize($factuur['aantallen']);
        $prijzen = unserialize($factuur['prijzen']);
        $artikelnummers = unserialize($factuur['artikelnummers']);
        $customer = Customer::where("klantnummer", $klantnummer)->first();
        $product = new Product();
        foreach($artikelnummers as $key=>$value) {
            $product->add($aantallen[$key][0], $prijzen[$key][0], Part::where('artikelnummer', $key)->first(), $key);  
            }
            $subtotal = $product->totalPrice;
            $BTW = $subtotal / 100 * 5;
            $total = $subtotal + $BTW;
        $pdf = PDF::loadView('factuur',['products' => $product->items, 'factuurID' => $id, 'customer' => $customer, 'subtotal' => $subtotal, 'BTW' => $BTW, 'total' => $total, 'datum' => $datum]);
        return $pdf->download('factuur.pdf');
    }
}