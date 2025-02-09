<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Registration Page</title>
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

        .registration-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .registration-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .registration-container h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .registration-container p {
            margin-bottom: 30px;
            color: #666;
            font-size: 0.9rem;
        }

        .registration-container input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .registration-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        .registration-container input::placeholder {
            color: #999;
        }

        .registration-container button {
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

        .registration-container button:hover {
            background: #0056b3;
            transform: scale(1.02);
        }

        .registration-container button:active {
            transform: scale(0.98);
        }

        .registration-container .login-link {
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }

        .registration-container .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .registration-container .login-link a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="registration-container">
        <h2>Create an Account</h2>
        <p>Sign up to get started.</p>

        <!-- Success Message -->
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
</body>

</html>
