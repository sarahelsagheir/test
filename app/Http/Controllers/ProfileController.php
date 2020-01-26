<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
use Intervention\Image\Facades\Image;
use App\Book;


class ProfileController extends Controller
{
        /**

     * Create a new controller instance.

     *

     * @return void

     */


    public function profile(){
        return view('profile');
    }
    public function profileUpdate(Request $request){

        $validatedData = $request->validate([
         'name'=>'required|min:6|string|max:255',
         'email'=>'required|unique:users,email|string|max:255'
        ]);
        $user= Auth::user();
        $user->name=$request['name'];    
        $user->email=$request['email'];          
        $user->save();
        
       return back()->with('message','profile updated');
    }
    public function changePasswordForm(){
        return view('changePassword');
    }
    public function changePassword(Request $request){
     if(!(Hash::check($request->get('current_password'),Auth::user()->password))){
        return back()->with('error','your current password does not match');
    }
   if(strcmp($request->get('current_password'),$request->get('new_password'))==0){
    return back()->with('error','your new password cannot be the same wirh your current password');
   }

$request->validate([
    'current_password'=>'required',
    'new_password'    =>'required|string|min:8', 
    'new_confirm_password' => ['same:new_password'],

]);
$user = Auth::user();
$user->password = bcrypt($request->get('new_password'));
$user->save();
return back()->with('message','password changed successfully');
    }
    public function getProfileAvatar(){
return view('profilePicture');
    }
    public function profilePictureUpload(Request $request){
        $this->validate($request, [
                  'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
              ]);
      
        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $filename= time(). "." .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(250,250)->save(public_path('/image/' . $filename));
            $user= Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
    return back()->with('message','Profile Picture Uploaded Successfully');
    }
    public function getBookForm(){

        return view('addBook');  

            }

    public function addBook(Request $request){

        $this->validate($request, [

            'category'=>'required',

            'author'=>'required|min:6|string',

            'title'=>'required|min:6|string',

         'cover_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $cover_img=$request->cover_img->store('images');
        $books= Book::create([
        'title' => $request->title,
        'cover_img' => $cover_img,
        'author' => $request->author,
        'category' => $request->category,
        'user_id' => $request->user()->id
           ]);

       $books->save();

        return redirect(route('books')) ->with('message','Thanks For Sharing');

            }

            public function getBooks(){

                $books = book::where('user_id','=',auth()->user()->id)->get();

                return view('books',[
                    'books'=> $books
                ]);  

            
                    }  
                    public function deleteBook($id)
                    {
                        $books = Book::find($id);
                        //delete
                        $books->delete();
                        return back();

                        }                            

        }

