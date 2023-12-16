<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3490dc;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2779bd;
        }

        .error-message {
            color: #d9534f;
            margin-top: 10px;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        a {
            color: #3490dc;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Login</h2>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" value="{{ old('cpf') }}" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>

        @if ($errors->any())
            <div class="error-message">
                <strong>Erro:</strong> Credenciais inválidas.
            </div>
        @endif

        <p>Não tem uma conta? <a href="{{ route('register') }}">Registre-se aqui</a>.</p>
    </form>
</body>
</html>