<h1>Your Notes</h1>
@foreach ($usernotes as $item)

<ul style="list-style-type: none">
    <li><strong>Note Id :</strong>{{$item->id}}</li>
    <li><strong>Title :</strong>{{$item->title}}</li>
    <li><strong>Description :</strong>{{$item->description}}</li>
    <li><strong>Created At :</strong>{{$item->created_at}}</li>
    <li><strong>Updated At :</strong>{{$item->updated_at}}</li>
    <li><strong>User Id :</strong>{{$item->user_id}}</li>
</ul>

@endforeach
