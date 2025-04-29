<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            font-family: 'Poppins', sans-serif;
            align-items: center;
        }

        .container {
            margin-top: 80px; /* Move everything a little down */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 48px;
            color: #333;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }

        form {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        label {
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #74ebd5;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #56c6c6;
        }
    </style>
</head>
<body>


    <div class="container">
        <h1>Login !!</h1>

        <form action="login_form_process.php" method="POST">
            <label for="name">ENTER USER NAME</label>
            <input type="text" id="name" name="name" required>

            <label for="password">ENTER PASSWORD</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
