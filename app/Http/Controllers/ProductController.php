<?php

namespace App\Http\Controllers;
use App\Cart;
use App\Product;
use App\Book;
use App\Mail\BorrowSucessful;
use App\Mail\PurchaseSuccessful;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Order;
use App\User;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;

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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Book $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
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

}


