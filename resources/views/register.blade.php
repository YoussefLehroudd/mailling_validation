<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
            min-height: 100vh;
        }
        .container {
            display: flex;
            padding: 2rem;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .users-panel {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-height: 80vh;
            overflow-y: auto;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            text-align: center;
            padding: 0.5rem;
            background-color: #ffe6e6;
            border-radius: 4px;
            display: none;
        }
        .error-message.show {
            display: block;
        }
        .success-message {
            color: #198754;
            background-color: #d1e7dd;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #0b5ed7;
        }
        .user-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .user-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        .user-item:last-child {
            border-bottom: none;
        }
        .user-name {
            font-weight: bold;
            color: #333;
        }
        .user-email {
            color: #666;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .user-date {
            color: #999;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Registration Form</h2>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation">
                </div>

                @if($errors->any())
                    <div class="error-message show">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit">Register</button>
            </form>
        </div>

        <div class="users-panel">
            <h2>Registered Users</h2>
            <ul class="user-list">
                @foreach($registrations as $user)
                    <li class="user-item">
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-email">{{ $user->email }}</div>
                        <div class="user-date">{{ $user->created_at->diffForHumans() }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                const errorMessage = document.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
