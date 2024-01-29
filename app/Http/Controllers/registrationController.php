<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;


class registrationController extends Controller
{
    //
    public function create_register(Request $req){
        try{
            $req->validate([
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ], [
                'name.required' => 'The name field is required.',
                'nam.min' => 'The name should not be less than 3 characters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password should not be less than 6 characters.'
            ]);
    
            $data = $req->only(['name', 'email', 'password']);
            User::create($data);
    
            // return response()->json(['message' => 'Data inserted successfully']);
            return redirect()->back()->with('registration_success','Data inserted successfully');
        }catch(QueryException $e){
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { 
                return redirect()->back()->withErrors(['email_found' => 'The email address is already in use.'])->withInput();
            }

            return redirect()->back()->withErrors(['database' => 'An error occurred while saving the data.'])->withInput();
        }            
    }

    
}

