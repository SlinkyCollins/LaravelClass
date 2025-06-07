<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</head>

<body>
    <div>
        <a href="/user/{{ $user->id }}">Check my notes</a>
    </div>
    <div>
        @if (session('productmessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('productmessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="/dashboard/ecommerce/{{ $user->id }}">Go to e-commerce page</a>
    </div>
    <div>Welcome to dashboard {{ $user->name }} </div>
    <div>Your email: {{ $user->email }} </div>
    <div>Your id: {{ $user->id }} </div>

    <div class="m-3">
        @if ($user->profile_picture)
            <img class="image rounded-circle" src="uploads/profile_pics/{{ $user->profile_picture }}" alt="Profile Pic"
                style="width: 80px;height: 80px; padding: 10px; margin: 0px;">
        @else
            <img src="" alt="Default Profile">
        @endif
        <button><a href="/dashboard/updatepfp/{{ $user->id }}">Update Profile picture</a></button>
        @if (session('profilemessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('profilemessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>


    <div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete
            Account</button>
    </div>

    {{-- delete account modal --}}
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/deleteuser" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteAccountModal">Delete Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <p>Are you sure you want to delete your account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No, go back</button>
                        <button type="submit" name="DeleteAccount" class="btn btn-danger" name="Logout"
                            data-bs-dismiss="modal">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div>
        <a href="/dashboard/{{ $user->id }}">Update Details</a>
    </div>


    <div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#logoutModal">Logout</button>
    </div>
    {{-- logout modal --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/logout" method="get">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="logoutModal">Log Out</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <p>Are you sure you want to log out?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No, stay logged
                            in</button>
                        <button type="submit" class="btn btn-danger" name="Logout"
                            data-bs-dismiss="modal">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <form action="/dashboard" method="POST" enctype="multipart/form-data"
        class="container p-5 mt-4 card mx-auto d-flex justify-center w-50 gap-3">
        @csrf
        @if (session('notemessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('notemessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Create a note</h1>
        <input type="hidden" name="userId" value="{{ $user->id }}">
        <input type="text" class="form-control" name="noteTitle" placeholder="Note Title">
        <textarea class="form-control" name="noteDesc" placeholder="Note Decription" cols="30" rows="10"></textarea>
        <input type="file" name="image" id="">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    @if (isset($notes) && count($notes) > 0)
        <div class="mt-4">
            <h3>Your Notes</h3>
            <ul>
                @foreach ($notes as $note)
                    <li><strong>{{ $note->title }}</strong>: {{ $note->description }}</li>
                    <img src="/image/{{ $note->note_image }}" alt="Note Image" width="50" height="50">

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $note->id }}">Edit</button>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $note->id }}">Delete</button>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $note->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="/dashboard/deletenote/{{ $note->id }}" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModalLabel{{ $note->id }}">Delete
                                            Note</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this note?</p>
                                        @csrf
                                        <input type="hidden" name="noteId" value="{{ $note->id }}">
                                        <input type="hidden" name="userId" value="{{ $user->id }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger"
                                            data-bs-dismiss="modal">Yes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal (inside the loop, dynamic ID per note) -->
                    <div class="modal fade" id="editModal{{ $note->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $note->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="/dashboard/editnote/{{ $note->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $note->id }}">Edit Note</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex flex-column gap-3">
                                        <input type="text" class="form-control" name="editNoteTitle"
                                            value="{{ $note->title }}" placeholder="Note Title">
                                        <textarea class="form-control" name="editNoteDesc" placeholder="Note Description">{{ $note->description }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p>Created at: {{ $note->created_at }}</p>
                    <p>Updated at: {{ $note->updated_at }}</p>
                @endforeach
            </ul>
        </div>
    @else
        <p class="text-center text-primary mt-4">You don't have any notes yet. Create one above 👆</p>
    @endif



</body>

</html>
