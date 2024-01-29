<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class loginController extends Controller
{
    //

    public function login_user(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password should be more than 6 characters.'
        ]);
       
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }else {
            return redirect()->back()->withErrors(['login' => 'Login Failed']);
        }

        // return redirect()->route('create_login')->with('error', ['Invalid credentials']);
    }

    public function logout(){
        Auth::logout();
        // Session::flush();
        return redirect('/')->with('logout_success', 'Logout successful.');
    }


    public function change_password(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|min:6',
            'cnf_password' => 'required|same:new_password|min:6',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'new_password.required' => 'The password field is required.',
            'new_password.min' => 'The password should be more than 6 characters.',
            'cnf_password.required' => 'The confirmation password field is required.',
            'cnf_password.same' => 'The confirmation password does not match with the password.',
            'cnf_password.min' => 'The confirmation password should be at least 6 characters.',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password updated successfully.');
        }else{
            return redirect()->back()->withErrors(['email_not_found'=>'Email not found in the database.']);
        }
    }

    public function categories(){
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function subcategories($id, $name){
        // $subcategories = Subcategory::all();
        $subcategories = Subcategory::where('category_id', $id)->get();
        return view('subCategories', compact('id','name','subcategories'));
    }
    
    public function create_category(Request $req){
        $req->validate([
            'name' => 'required|min:3'
        ],
        [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
        ]);

        $data = $req->only(['name']);
        Category::create($data);

        $categories = Category::all();
        // dd($categories);
        return redirect()->route('categories')->with(['category_success' => 'Data inserted successfully', 'categories' => $categories]);
        // return redirect()->route('example.route')->with(compact('categories'))->with('category_success', 'Data inserted successfully');
        // return response()->json(['message' => 'Data inserted successfully']);
        // return redirect()->back()->with(['category_success'=>'Data inserted successfully', 'category' => $categories]);
    }

    public function update_category(Request $request){
        // $request->validate([
        //     'name' => 'required|min:3'
        // ],
        // [
        //     'name.required' => 'The name field is required.',
        //     'name.min' => 'The name must be at least 3 characters.',
        // ]);

        $categoryId = $request->input('id');
        $category = Category::find($categoryId);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }
        $category->name = $request->input('name');
        $category->save();

        return redirect()->back()->with('category_success', 'Category updated successfully');
    }

    
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }
        $category->delete();

        return redirect()->back()->with('category_success', 'Category deleted successfully');
    }

    public function create_subcategories(Request $req){
        $req->validate([
            'name' => 'required|min:3'
        ],
        [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
        ]);
        $cat_id = $req->category_id;
        $cat_name = $req->category_name;
        $data = $req->only(['category_id','name']);
        // dd($data);
        Subcategory::create($data);

        // $subcategories = Subcategory::all();
        $subcategories = Subcategory::where('category_id', $cat_id)->get();
        // dd($categories);
        return redirect()->route('sub_categories', ['id' => $cat_id, 'name' => $cat_name])->with(['category_success' => 'Data inserted successfully', 'subcategories' => $subcategories]);
    }

    public function destroy_subcategory($id){
        $category = Subcategory::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'SucCategory not found');
        }
        $category->delete();

        return redirect()->back()->with('category_success', 'Subcategory deleted successfully');
    }

    public function update_subcategory(Request $request){
        // dd($request->input('id'));
        $categoryId = $request->input('id');
        $category = Subcategory::find($categoryId);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }
        $category->name = $request->input('name');
        $category->save();

        return redirect()->back()->with('category_success', 'Sub Category updated successfully');
    }

}
