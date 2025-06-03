@extends('nav')

@section('allnotesanduser')
    <h1 class="my-2"> All Notes Page</h1>

    @foreach ($notes as $note)
        <div class="shadow-sm mb-2 p-4">
            <strong>Note:</strong>
            <ul>
                <li><strong>Note ID:</strong> {{ $note->id }}</li>
                <li><strong>Title:</strong> {{ $note->title }}</li>
                <li><strong>Description:</strong> {{ $note->description }}</li>
                <li><strong>User ID:</strong> {{ $note->user_id }}</li>
                <li><strong>Created At:</strong> {{ $note->created_at }}</li>
                <li><strong>Updated At:</strong> {{ $note->updated_at }}</li>
            </ul>
            <div class="mb-2 p-3">
                @if ($note->user)
                    <ul>
                        <li><strong>Name:</strong> {{ $note->user->name }}</li>
                        <li><strong>Email:</strong> {{ $note->user->email }}</li>
                        <li><strong>Created At:</strong> {{ $note->user->created_at }}</li>
                        <li><strong>Updated At:</strong> {{ $note->user->updated_at }}</li>
                    </ul>
                @else
                    <p>No user associated with this note.</p>
                @endif

            </div>
        </div>
    @endforeach
@endsection
