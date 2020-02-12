<?php

namespace App\Http\Controllers;

use App\Book;
use App\Product;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\toast;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('chat.index');
    }
    public function store(){
        if ( session('success'))
        {
            toast(session('success'), 'success');
        }

        $latestProducts= Book::latest()->take(3)->get();
        return view('store',[
            'latestProducts'=>$latestProducts
        ]);
    }
    public function mySearch(Request $request)
    {
    	if($request->has('search')){
    		$products = Book::search($request->get('search'))->get();	
    	}else{
    		$products = Book::get();
    	}


    	return view('borrow.index', compact('products'));
    }
    // public function autocomplete(Request $request)
    // {
    //     $data = Book::select("title")
    //             ->where("title","LIKE","%{$request->input('query')}%")
    //             ->get();
   
    //     return response()->json($data);
    // }

}
