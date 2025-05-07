<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></Open House 2025></title>
    <link rel="stylesheet" href={{ asset('style.css') }}>
</head>
<body>
    <div class="wonderland-background">
        <div class="login-container">            
            <div class="login-content">
                <h1 class="login-title">Wonderland Gate</h1>
                
                <form class="login-form" method="POST" action="{{ route('aksi') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Username" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" id="pass" name="pass" placeholder="Password" required>
                    </div>
                    
                    <button type="submit" class="login-btn">
                        Enter Wonderland
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
