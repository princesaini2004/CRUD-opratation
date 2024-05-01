<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="formcontainer">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('Auth.loginByAuth') }}" method="post" class="form">
            <div class="formtitle">
                <h1>Login</h1>
                <h5>Welcome back!</h5>
               </div>
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required  placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter Password">
            </div>
            <br>
            <input type="submit" name="submit" class="submitbtn" >
            <a href="{{route('forgot.forgot')}}">Forgot Password</a>
            <h4>Don't have an account? <a href={{ route('Crud.create') }}><b>Sign up</b></a></h4>
            <br>
        </form>
    </div>
</body>

</html>
