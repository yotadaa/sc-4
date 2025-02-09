<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .login-container p {
            margin-bottom: 30px;
            color: #666;
            font-size: 0.9rem;
        }

        .login-container input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        .login-container input::placeholder {
            color: #999;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .login-container button:hover {
            background: #0056b3;
            transform: scale(1.02);
        }

        .login-container button:active {
            transform: scale(0.98);
        }

        .login-container .forgot-password {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .login-container .forgot-password:hover {
            color: #0056b3;
        }

        .login-container .signup-link {
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }

        .login-container .signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-container .signup-link a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Welcome Back</h2>
        <p>Sign in to continue to your account.</p>

        <!-- Success Message -->
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

            <input type="text" name="email" placeholder="Email or Username" value="{{ old('email') }}" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <button type="submit">Login</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </div>
</body>

</html>
