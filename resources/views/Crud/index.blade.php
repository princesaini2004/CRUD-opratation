<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Table</title>
</head>

<body>
    <div class="indexpage">
        <nav class="dnavbar">
            {{-- <a class="" href={{ route('Crud.index') }}>CRUDPosts</a> --}}
            <input type="search" name="search" id="search" class="form-control searchinp" placeholder=" &#xf002; You can search here" />
            <div class="colm">
                <a class="" href={{ route('Auth.login') }}>Sign In</a>
                <a class="" href={{ route('Crud.create') }}>Sign Up</a>
            </div>
        </nav>
        <table class="table table-striped tbody table-bordered table-centered" id="datatable">
            <br>
            <thead>
                <tr>
                    <th scope="col">Sr no.</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">PhoneNumber</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</cth>
                </tr>
            </thead>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('Crud.listJson') }}',
                    type: "POST",
                    data: function(data) {
                        data.cSearch = $("#search").val();
                    }
                },
                order: ['1', 'DESC'],
                pageLength: 10,
                searching: false,
                sorting: true,
                aoColumns: [{
                        data: 'id',
                    },
                    {
                        data: 'FirstName',
                    },
                    {
                        data: 'LastName',
                    },
                    {
                        data: 'Email',
                    },
                    {
                        data: 'PhoneNumber',
                    },
                    {
                        data: 'Address',
                    },
                    {
                        data: 'id',
                        
                        render: function(data, type, row) {
                            var showUrl = '{{ route('Crud.show', ':id') }}'.replace(':id', row.id);
                            var editUrl = '{{ route('Crud.edit', ':id') }}'.replace(':id', row.id);

                            return '<a href="' + showUrl +
                                '" class="btn btn-primary"><i class="far fa-eye"></i></a>  &nbsp;' +
                                '<a href="' + editUrl +
                                '" class="btn btn-primary"><i class="fas fa-edit"></i></a>' +
                                ' <button onclick="OnDelete(' + row.id +
                                ')" class="btn btn-danger" id="deletebtn"><i class="far fa-trash-alt"></i></button>';
                        }
                    }
                ]
            });
        });

        function OnDelete(Id) {
            debugger;
            $.ajax({
                url: '{{ route('Crud.destroy', '') }}' + '/' + Id, 
                type: "DELETE",
                success: function(result) {
                    $('#datatable').DataTable().ajax.reload();
                },
            });
        }


        $("#search").keyup(function(event) {
            $('#datatable').DataTable().ajax.reload();

        });
    </script>
</body>

</html>
