<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background-image: url('https://images.unsplash.com/photo-1517511620798-cec17d428bc0');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .demo-badge {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            font-style: italic;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .register-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 50px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 450px;
        }

        .register-container h1 {
            margin-bottom: 28px;
            text-align: center;
            font-size: 1.9rem;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        form .field {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 360px;
        }

        form .field label {
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #444;
        }

        form .field input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            width: 100%;
            transition: border-color 0.3s;
        }

        form .field input:focus {
            border-color: #1976d2;
            outline: none;
        }

        .Actions {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .Actions input[type=submit] {
            padding: 18px 48px;
            background: linear-gradient(to right, #42a5f5, #1e88e5);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-weight: bold;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 6px 18px rgba(33, 150, 243, 0.4);
            width: 100%;
            max-width: 400px;
        }

        .Actions input[type=submit]:hover {
            background: linear-gradient(to right, #1e88e5, #1565c0);
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(25, 118, 210, 0.5);
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

        @media (max-width: 600px) {
            .register-container {
                margin: 20px;
                padding: 32px 24px;
            }

            .Actions input[type=submit] {
                width: 100%;
            }

            .demo-badge {
                font-size: 0.8rem;
                top: 12px;
                right: 16px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="demo-badge">For SunnySideup Demo</div>

    <div class="register-container">
        <h1>Create Your Account</h1>

        <% if $Message %>
            <div class="message $MessageType">$Message</div>
        <% end_if %>

        $RegisterForm
    </div>
</body>
</html>
