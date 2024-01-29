<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add additional stylesheets as needed -->
    <style>
        .sidebar-sticky a{
            color:#fff
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-primary sidebar" style="height:100vh">
                <div class="sidebar-sticky mt-5">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('dashboard_page')}}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('categories')}}">
                                Categories & Sub-categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('forget_password')}}">
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{Route('logout')}}">
                                Logout
                            </a>
                        </li>
                        <!-- Add more options as needed -->
                    </ul>
                </div>
            </nav>

            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 mt-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and any additional scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
