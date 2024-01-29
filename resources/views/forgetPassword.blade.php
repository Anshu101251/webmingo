@extends('dashboard')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{Route('change_password')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <h1 class="h2"> Forget Password </h1>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">New Password</label>
                                <input type="text" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                @error('new_password')
                                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="text" name="cnf_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                @error('cnf_password')
                                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="submit_btn"> Change Password </button>
                            </div>
                            
                        </div>
                        
                        @error('email_not_found')
                            <div class="alert alert-danger mt-3" id="error_msg">{{ $message }}</div>
                        @enderror
                        <!-- @if ($errors->any())
                            <div class="alert alert-danger mt-3" id="error_msg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->

                        @if(session('success'))
                            <div class="alert alert-success mt-3" id="error_msg">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                    

                </div>
            </div>
        </div>

@endsection
