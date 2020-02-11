<?php

namespace App\Http\Controllers;
use App\Cart;
use App\Product;
use App\Book;
use App\Mail\BorrowSucessful;
use App\Mail\PurchaseSuccessful;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Order;
use Illuminate\Support\Facades\DB;
use App\User as AppUser;


use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Book::all();


        return view('product.index',[

            'products'=>$products

        ]);

    }
    public function borrowIndex()
    {
        $products= book::where('user_id','!=',auth()->user()->id)->get();
        

        return view('borrow.index',[
            'products'=>$products
        ]);
    }
 public function sharedBook(){
    $products= book::where('user_id','=',auth()->user()->id)
    ->where('status','=','0')
    ->get();
    return view('borrow.sharedBook',[

        'products'=>$products

    ]);


 }

    public function update(Request $request, Book $product)
    {
        {
            $request->validate([
                'qty' => 'required|numeric|min:1'
            ]);
    
            $cart = new Cart(session()->get('cart'));
            $cart->updateQty($product->id, $request->qty);
            session()->put('cart', $cart);
            return redirect()->route('cart.show')->with('success', 'Product updated');
        }
    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $product)
    {
        $cart = new Cart( session()->get('cart'));
        $cart->remove($product->id);

        if( $cart->totalQty <= 0 ) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product was removed');

    }
    public function addToCart(Book $product) {
        
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart', $cart);
        return redirect()->route('product.index')->with('success', 'Product was added');

    }
    public function showCart() {

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('cart.show', compact('cart'));
    }
    public function checkout($amount) {
       if($amount !=0){
        return view('cart.checkout',compact('amount'));
}
else
{

    Mail::to(auth::user()->email)->send(new BorrowSucessful());
        session()->forget('cart'); 

    return back();
}
    }
public function charge(Request $request) {

    $charge = Stripe::charges()->create([
        'currency' => 'USD',
        'source' => $request->stripeToken,
        'amount'   => $request->amount,
        'description' => ' Test from laravel new app'
    ]);
    $chargeId = $charge['id'];

    if ($chargeId) {
        
    
            // save order in orders table ...
            
            auth()->user()->orders()->create([
                'cart' => serialize( session()->get('cart'))
            ]);

        session()->forget('cart'); 
        Mail::to(auth::user()->email)->send(new PurchaseSuccessful());
 
        return redirect()->route('store')->with('success', " Payment was done. Thanks");
    } else {
        return redirect()->back();
    }

}
public function search( Request $request) {

    $request->validate([

        'q' => 'required'
    ]);
    $q = $request->q;

    $filteredBooks = Book::where('title', 'like', '%' . $q . '%')
                            ->orWhere('price', 'like', '%' . $q . '%')      
                            ->orWhere('category', 'like', '%' . $q . '%')                            
                      
                            ->get();

    if ($filteredBooks->count()) {

        return view('product.index')->with([
            'products' =>  $filteredBooks
        ]);
    } else {
        return redirect('/products')->with([
            'status' , "search failed ,, please try again"
        ]);
    }

    }
        // axios search

        public function searchajax($q) {
            if ($q) {
                $data = Book::where('title', 'like' , '%'. $q .'%')->get();
    
            } else {
                $data = Book::all();
            }
            
            return response()->json($data);
        }
    }
        



