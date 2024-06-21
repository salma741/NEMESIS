<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <title>SIGN-IN</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mohave:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Mohave', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://img.freepik.com/free-photo/low-angle-view-unrecognizable-muscular-build-man-preparing-lifting-barbell-health-club_637285-2497.jpg?t=st=1710992269~exp=1710995869~hmac=cc415c3850d094a0b16233abc6a0a68ee2a9442dc523161e3ae7be1990b71ede&w=826');
            background-size: cover;
            background-position: center;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 50px;
            color: red;
            font-weight: 700;
            margin-bottom: -5px;
        }

        h2 {
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
        }

        .form-container {
            width: 350px;
            padding: 20px;
            border-radius: 8px;
            background-color: rgba(55, 45, 45, 0.7);
            margin: 20px 0;
            position: relative;
            z-index: 1;
        }

        .form-label {
            color: white;
        }

        .form-control {
            background-color: transparent;
            border: 1px solid white;
            color: white;
        }

        .form-control::placeholder {
            color: white;
        }

        .form-control:focus {
            border-color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }

        .btn-danger {
            width: 100%;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: .2s all;
        }

        .btn-danger:hover {
            transform: scale(1.05);
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border: 1px solid #ccc;
            color: #333;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%;
        }

        .btn-google:hover {
            background-color: #f5f5f5;
            border-color: #bbb;
        }

        .google-logo {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .small {
            display: block;
            margin-top: 10px;
            color: white;
        }

        .btn-link {
            padding: 0;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 45px;
                margin-top: 0px;
            }

            p {
                font-size: 20px;
                margin-top: 5px;
                margin-bottom: 15px;
            }

            .btn-danger,
            .btn-google {
                width: 100%;
            }

            h5 {
                text-align: center;
            }
        }

        .register-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
  
    <div class="overlay"></div>
    <div id="loginContainer" class="form-container">
        <div class="text-center">
            <h1><i>SIGN-IN</i></h1>
            <h2>YOUR ACCOUNT</h2>
        </div>
    
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ URL::to('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="InputEmail" class="form-label">Email</label>
                <input type="text" class="form-control" name="username" id="InputEmail" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Enter your password">
            </div>
            <p class="mb-2">
                <a href="{{route('forgot-password')}}" style="font-size: 12px; margin-top: 1%">forgot password?</a>
            </p>
            <span class="small">Don't have an account? <button class="btn btn-link btn-sm" id="showRegisterForm" type="button">Register</button></span>
            <button type="submit" class="btn btn-danger">SUBMIT</button>
            <a href="{{ route('redirect') }}" class="btn btn-google">
                <img src="assets/images/google.png" alt="Google Logo" class="google-logo">
                Login With Google
            </a>
        </form>
    </div>
    <div id="registerContainer" class="form-container register-container" style="display:none;margin: 150px;">
        <div class="text-center">
            <h1><i>SIGN-UP</i></h1>
            <h2>YOUR ACCOUNT</h2>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
            </div>
            <span class="small">Already have an account? <button class="btn btn-link btn-sm" id="showLoginForm" type="button">Login</button></span>
        </form>
    </div>

    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showRegisterForm').click(function() {
                $('#loginContainer').hide();
                $('#registerContainer').show();
            });
            $('#showLoginForm').click(function() {
                $('#registerContainer').hide();
                $('#loginContainer').show();
            });
        });
    </script>
</body>

</html>
