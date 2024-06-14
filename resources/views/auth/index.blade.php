<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .card-centered {
            margin-top: 5%;
            max-width: 500px;
        }
        .form-switch-link {
            cursor: pointer;
        }
        .custom-text {
            color: #000;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="card card-centered">
        <div class="card-body">
            <div class="container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div id="loginForm">
                            <h2 class="text-center">Login</h2>
                            <form action="{{ URL::to('/login') }}" method="POST">
                                @csrf
                                <div class="form-group mt-4">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                    <p class="mb-1">
                                        <a href="{{route('forgot-password')}}" style="font-size: 12px; margin-top: 1%">forgot password?</a>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-2">
                                    <div class="col-12 d-flex justify-content-center">
                                        <a href="{{ route('redirect') }}" class="btn btn-transparent btn-outline-dark btn-block">
                                            <img src="assets/images/google.png" alt="Google Logo" style="width: 30px; height: 30px; margin-right: 10px;">
                                            Login With Google
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <span class="custom-text">Don't have an account?</span>
                            <button class="btn btn-link btn-sm" id="showRegisterForm">Register</button>
                        </div>
                        <div id="registerForm" style="display:none;">
                            <h2 class="text-center">Register</h2>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contact:</label>
                                    <input type="text" class="form-control" id="contact" name="contact" required>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </div>
                            </form>
                            <span class="custom-text">Already have an account?</span>
                            <button class="btn btn-link btn-sm" id="showLoginForm">Login</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#showRegisterForm').click(function() {
            $('#loginForm').hide();
            $('#registerForm').show();
        });
        $('#showLoginForm').click(function() {
            $('#registerForm').hide();
            $('#loginForm').show();
        });
    });
</script>
</body>
</html>
