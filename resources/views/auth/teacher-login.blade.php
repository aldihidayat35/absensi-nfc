<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Absensi Berbasis NFC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #8c63ec, #bbb9f8);
        }

        .login-container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            display: flex;
            flex-direction: row;
            width: 100%;
            max-width: 960px;
            height: auto;
            border-radius: 20px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .welcome-section {
            flex: 1;
            background: linear-gradient(135deg, #a47ff8, #b4b1ff);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .welcome-section p {
            max-width: 400px;
            font-size: 1rem;
            opacity: 0.95;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeInRight 1s ease;
        }

        .form-section h4 {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 50px;
            padding-left: 45px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(105, 90, 200, 0.4);
            border-color: #a88beb;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .input-group {
            position: relative;
        }

        .btn-login {
            width: 100%;
            border-radius: 50px;
            background: linear-gradient(to right, #926af1, #7469b6);
            border: none;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #7469b6, #a88beb);
        }

        .form-footer {
            font-size: 0.9rem;
            text-align: center;
            margin-top: 1rem;
            color: #888;
        }

        .form-footer a {
            color: #7469b6;
            text-decoration: none;
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #6a11cb;
        }
    </style>
</head>


<body>
    <div class="login-container">
        <div class="login-card">
            <div class="welcome-section">
                <h1>Welcome back!</h1>
                <p>Masuk ke akun Sistem Absensi Berbasis NFC Anda dan kelola kehadiran dengan efisien.</p>
            </div>
            <div class="form-section">
                <div class="text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Logo" class="logo">
                    <div class="brand-title">Sistem Absensi Berbasis NFC</div>
                    <p>Masuk ke akun Sistem Absensi Berbasis NFC Anda dan kelola kehadiran dengan efisien.</p>

                </div>
                <h4>Sign In</h4>
                <form method="POST" action="{{ route('teacher.login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-icon"><i class="bi bi-person"></i></span>
                        <input type="text" name="nip" class="form-control" placeholder="Username or email"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-icon"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3 align-items-center">
                        <div>
                            <input type="checkbox" id="remember"> <label for="remember">Remember me</label>
                        </div>
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-login">Sign In</button>
                    <div class="form-footer">
                        <p>New here? <a href="#">Create an Account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
