<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <title>Create Post</title>
</head>

<body>
    <div class="formcontainer">
                <form method="post" action="{{ route('forgot.forgot') }}" class="form">
                    <div class="formtitle">
                        <h1>Forgot password</h1>
                        <h5>Please enter your Email to forgot password</h5>
                       </div>
                    @csrf
                    <div>
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" required placeholder="&nbsp; Enter your Email">
                    </div>
                    <div>
                        <br/>
                        {{-- <button type="submit">Send Email </button> --}}
                        <input type="submit" name="submit" class="submitbtn">
                        <br/>
                        <br/>
                    </div>
                </form>
    </div>
</body>

</html>