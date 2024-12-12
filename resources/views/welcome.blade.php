<!-- resources/views/landing.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            margin-bottom: 50px;
        }
        p {
            font-size: 20px;
            size: 70px;
        }
        .col {
            margin-top: 15px;
        }
        .container {
            margin-top: 100px;
        }
        .lead {
            color: #6c757d;
        }
        .card {
            background-color: #ffffffc4;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-register {
            background-color: #ff0000;
            color: #fff;
        }
        .btn-management {
            background-color: #25ad20;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        @if(auth()->check())
            <a class="navbar-brand nav-link btn btn-management" href="/cars">Car Management</a>
        @endif
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Check if user is logged in -->
                @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link btn btn-custom" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link btn btn-custom" href="/profile">Profile</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-custom" href="/login">Login</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link btn btn-register" href="register">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="container text-center">
        <div class="card p-4 mb-5">
            <h1 class="display-4" style="color: #007bff;">Welcome to your Car Management</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col">
                <div class="card p-3">
                    <p class="lead" style="color: #000000;">Discover the best solution to manage your car sales with our app!</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <p class="lead" style="color: #000000;">Our intuitive and powerful system allows you to keep track of your sales, manage inventories, and generate detailed reports. Everything you need to grow your automotive business!</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <p class="lead" style="color: #000000;">Boost your sales with our integrated marketing tools and customer relationship management features. Reach out to more potential customers and close deals faster!</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <p class="lead" style="color: #000000;">Stay ahead of the competition with real-time analytics and insights. Make informed decisions to optimize your sales strategy and increase your revenue!</p>
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <p class="lead" style="color: #000000;">Join thousands of satisfied users who have transformed their car sales process with our application. It's time to take your business to the next level!</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

