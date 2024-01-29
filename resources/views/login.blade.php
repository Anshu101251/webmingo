<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- In the <head> section -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{Route('create_login')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <h1 class="h2"> Login </h1>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                @error('password')
                                    <div class="alert" style="color:red;padding:0px;font-size:10px">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="submit_btn"> Login </button>
                            </div>
                            <div class="form-group" >
                                Don't have an account?<a href="{{Route('registration_page')}}" class="" > Register </a> 
                            </div>
                        </div>
                        
                        @error('login')
                            <div class="alert alert-danger mt-3" id="error_msg">{{ $message }}</div>
                        @enderror

                        <!-- @if ($errors->any())
                            <div class="alert alert-danger mt-3" id="error_msg">
                                <ul style="list-style-type:none">
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

        <script>
            // $(document).ready(function () {
            //     // var hide = document.getElementById('error_msg');
            //     setTimeout(() => {
            //         $('#error_msg').fadeOut(1500);
            //         // $('#error_msg').fadeOut('slow');
            //     }, 3000);
            // })
        </script>


    </body>
</html>
