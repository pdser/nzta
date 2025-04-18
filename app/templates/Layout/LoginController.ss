<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background-image: url('https://images.unsplash.com/photo-1517511620798-cec17d428bc0');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            box-sizing: border-box;
        }

        .login-badge {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-style: italic;
        }

        .login-container {
            background-color: rgba(255,255,255,0.95);
            padding: 40px 50px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            max-width: 480px;
            width: 100%;
            box-sizing: border-box;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 28px;
            color: #333;
            font-size: 1.9rem;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .field {
            display: flex;
            flex-direction: column;
            width: 100%;
            box-sizing: border-box;
        }

        .field label {
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 1rem;
            color: #444;
        }

        .field input {
            padding: 14px;
            font-size: 1.05rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .Actions {
            width: 100%;
            display: flex;
            justify-content: center;
            box-sizing: border-box;
        }

        .Actions input[type=submit],
        .register-button {
            padding: 16px 40px;
            background: linear-gradient(to right, #42a5f5, #1e88e5);
            color: white;
            border: none;
            border-radius: 999px;
            font-size: 1.15rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .Actions input[type=submit]:hover,
        .register-button:hover {
            background: linear-gradient(to right, #1e88e5, #1565c0);
        }

        .message.good {
            color: #2e7d32;
            text-align: center;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .message.bad {
            color: #d32f2f;
            text-align: center;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-badge">For SunnySideup Demo</div>

    <div class="login-container">
        <h1>Login</h1>

        <% if $Message %>
            <div class="message $MessageType">$Message</div>
        <% end_if %>
        
        $LoginForm
        <div class="register-link">
            <p>Don't have an account?</p>
            <p>Click here to <a href="{$BaseURL}register" class="register-link" class="register-link">Register</a></p>
    </div>
    </div>
    
</body>
</html>
