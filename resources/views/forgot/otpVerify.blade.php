<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <title>Enter OTP</title>
</head>

<body>
    <div class="formcontainer">
                <form method="post" action="{{route('forgot.Verifyotp')}}" class="form">
                    <div class="formtitle">
                        <h1>OTP Verify</h1>
                        <h5>Please enter OTP to verify</h5>
                       </div>
                    @csrf
                    <div>
                        <label for="otp">OTP</label>
                        <input type="hidden" name="userId" value={{$id}}>
                        <input id="otp" type="otp" class="form-control" name="otp" required placeholder="&nbsp; Enter OTP">
                    </div>
                    <div> <br/>
                        <input type="submit" name="submit" class="submitbtn">
                       
                        <br/>
                        <br/>
                    </div>
                </form>
    </div>
</body>

</html>