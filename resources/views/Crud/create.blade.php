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
    <div class="formcontainer registercont">
        <form action="{{ route('Crud.store') }}" method="post" class="signupform form">
            <br>
           <div class="formtitle">
            <h1>Quick Register</h1>
            <h5>Please enter your personal details to start a journey</h5>
           </div>
            <br>
            @csrf
            <div class="fullname form-group">
                <div class="nameinp">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" required placeholder="First name">    
                </div>
                <div class="nameinp">
                    <label for="MiddleName">Middle Name</label>
                <input type="text" class="form-control" id="MiddleName" name="MiddleName" required placeholder="Middle name">
                </div>
                <div class="nameinp">
                    <label for="LastName">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="LastName" required placeholder="Last name">
                </div>
                 </div>
                 <div class="form-group">
                     <label for="Email">Email Address</label>
                     <input type="text" class="form-control" id="Email" name="Email" required  placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text"class="form-control" id="password" name="password" placeholder="Password"/>
                    </div>
            <div class="form-group">
                <label for="PhoneNumber">PhoneNumber</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" required placeholder="PhoneNumber">
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" required placeholder="Address">
            </div>
            <br>
            <input type="submit" name="submit" class="submitbtn">
            <br>
            <h4>Allredy have an account?<a href={{ route('Auth.login') }}> Signin</a></h4>
            <br>
        </form>
    </div>
</body>

</html>
