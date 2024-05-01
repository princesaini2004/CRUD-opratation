<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- resources/views/auth/change-password.blade.php -->
    <div class="formcontainer registercont">
        <form action="{{ route('changePassword.changepass') }}" method="post" class="form">
            <div class="formtitle">
                <h1>Quick change</h1>
                <h5></h5>
            </div>
            @csrf
            <div>
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" required placeholder="Email Address">
            </div>
            <div>
                <label for="current_password">Current Password</label>
                <input id="current_password" type="password" name="current_password" required
                    placeholder=" current-password">
            </div>
            <div>
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required placeholder="New Password">
            </div>
            <div>
                <input type="submit" name="submit" class="submitbtn">
            </div>
                <h4 class="center">No need to change password<a href={{ route('Auth.login') }}>--Go Back</a></h4>
                <br>
        </form>
    </div>
</body>

</html>
