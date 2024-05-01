<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}" />
    <title>Post</title>
</head>

<body>
    <div class="formcontainer registercont">
            <div class="form signupform">
                <div class="formtitle">
                    <h1>Quick Show</h1>
                    <h5>Here you can see your details</h5>
                   </div>
                    <br>
                <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" readonly class="form-control" value="{{ $post->FirstName }}">
                </div>
                <div class="form-group">
                    <label for="MiddleName">Middle Name</label>
                    <input type="text" readonly class="form-control" value="{{ $post->MiddleName }}">
                </div>
                <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" readonly class="form-control" value="{{ $post->LastName }}">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" readonly class="form-control" value="{{ $post->Email }}">
                </div>
                <div class="form-group">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" readonly class="form-control" value="{{ $post->PhoneNumber }}">
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" readonly class="form-control" value="{{$post->Address }}">
                </div>
                <br>
                <div class="card-footer">
                    <a href="{{ route('Crud.edit', $post->id) }}"class="editbtn"><button >Edit </button></a>
                    <form action="{{ route('Crud.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deletebtn">Delete</button>
                    </form>
                </div>
                <br>
            <h4>No need to see <a href={{ route('Crud.index') }}>--Go back</a></h4>
            <br>
            </div>
        </div>
    </div>
</body>

</html>