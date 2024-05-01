<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <title>Edit Post</title>
</head>

<body>
    <div class="formcontainer registercont">
        <form action="{{ route('Crud.update', $post->id) }}" method="post" class="form signupform">
            <div class="formtitle">
                <h1>Update Post</h1>
                <h5>Please enter your personal details which you want to update</h5>
               </div>
            @csrf
            @method('PUT')
            
                <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" required
                        placeholder="&nbsp;  First name" value="{{ $post->FirstName }}">
                </div>
                <div class="form-group">
                    <label for="MiddleName">Middle Name</label>
                    <input type="text" class="form-control" id="MiddleName" name="MiddleName" required
                        placeholder="&nbsp;  Middle name" value=" {{ $post->MiddleName }}">
                </div>
                <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" required
                        placeholder="&nbsp;  Last name" value="{{ $post->LastName }}">
                </div>
            
            <div class="form-group">
                <label for="Email">Email Address</label>
                <input type="text" class="form-control" id="Email" name="Email" value="{{ $post->Email }}"
                    required>
            </div>
            <div class="form-group">
                <label for="PhoneNumber">PhoneNumber</label>
                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber"
                    value="{{ $post->PhoneNumber }}" required>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" value="{{ $post->Address }}"
                    required>
            </div>
            <br>
            {{-- <button type="submit" class="btn btn-primary">Update Post</button> --}}
            <input type="submit" name="submit" class="submitbtn">
            <br>
            <h4>No need to change -<a href={{ route('Crud.index') }}> Go back</a></h4>
            <br>
        </form>
    </div>
</body>

</html>
