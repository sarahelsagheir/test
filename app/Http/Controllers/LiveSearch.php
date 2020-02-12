<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveSearch extends Controller
{
        function index()
    {
     return view('live_search');
    }
    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '' )
      {
       $data = DB::table('books')->where('user_id','!=',auth()->user()->id)
         ->where('title', 'like', '%'.$query.'%')
         ->orwhere('price', 'like', '%'.$query.'%')
         ->orwhere('category', 'like', '%'.$query.'%')

         ->get();
         
      }
      else
      {
        $data = DB::table('books')
        ->where('user_id','!=',auth()->user()->id)
        ->where('price','!=','null')
        ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->title.'</td>
         <td>'.$row->price.'</td>

        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }



    public function search($search = null) {
      $search_text = $search;

      if ($search_text==NULL) {
          $data= Book::all();
      } else {
          $data=Book::where('name','LIKE', '%'.$search_text.'%')->get();
      }
      return view('results')->with('results',$data);
  }
  R


}
