<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
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
                            <p class="login-box-msg">Masukkan Password Baru</p>
                            <form action="{{ URL::to('/validasi-forgot-password-act') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$token}}">
                                <div class="form-group mt-4">
                                    <label for="password">Password Baru</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
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
