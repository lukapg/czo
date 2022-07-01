<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEDIS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/stilovi.css') }}">
</head>
<body>
    <div class="container" style="align-items: center;
    display: flex;
    justify-content: center;
    height: 100vh;">
        <div class="row login" style="align-items: center">
            <div class="card">
                <article class="card-header" style="background-color: #ca2129; display: flex;
                justify-content: center;">
                    <img class="img-fluid" src="{{url('images/logo.png')}}" alt="CEDIS logo" style="max-width: 100px">
                </article>
                <article class="card-body">
                    @if(request()->session()->exists('error'))
                    <div class="alert alert-danger text-center">
                        {{ request()->session()->get('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" id="prijava-form" name="prijava-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Korisničko ime" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Lozinka" required>
                        </div>
                        <button type="submit" class="btn btnCedis">Prijava</button>
                    </form>
                </article>
            </div> <!-- card.// -->
        </div>
    </div>    
</body>
</html>