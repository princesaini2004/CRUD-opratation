<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Document</title>
</head>

<body>
    <div class="formcontainer">
        <form action="{{ route('forgot.changeforgotpass') }}" method="post" class="form">
            @csrf
            <div class="formtitle">
                <h1>New Password</h1>
                <h5>Please enter new Password</h5>
               </div>
            <div>
                <input type="hidden" name="userId" value={{ $id }}>
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required placeholder="&nbsp; Password">
                <br>
               
            </div>
            <div>
                <input type="submit" name="submit" class="submitbtn">
                
                <br>
                <br>
            </div>
        </form>
    </div>
</body>

</html>
