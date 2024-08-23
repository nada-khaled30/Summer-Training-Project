<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        button {
            display: inline-block;
            font-size: 1.1rem;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .cta {
            margin-top: 20px;
        }
        .cta p {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Visiting Our Site!</h1>
        <div class="cta">
            <p>If you are a student, click the button below 👇</p>
            <button onclick="window.location.href='/student/login'">Student Login</button>
        </div>
        <div class="cta">
            <p>If you are an admin, click the button below 👇</p>
            <button onclick="window.location.href='/login'">Admin Login</button>
        </div>
    </div>
</body>
</html>
