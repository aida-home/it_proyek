<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <h1>WELCOME WORLD</h1>
   <div style="border: 3px solid black">
    <h2>Create a New Post</h2>
    <form action="/create-post" method="POST">
        @csrf
        <input type="text" name="title" placeholder="post title">
        <textarea name="body" placeholder="body content......"></textarea>
        <button>Save Post</button>
    </form>
   </div>

   <div style="border: 3px solid black;">
    <h2>All Post</h2>
    @foreach ($posts as $post)
    <div style="background-color: grey; padding: 10px; margin : 10px;">
        <h3>{{ $post['title'] }}</h3>
        {{ $post['body'] }}
        <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>

        <form action="/delete-post/{{ $post->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm ('Yakin dihapus?')">Delete</button>
        </form>
    </div>
    @endforeach
</div>
</body>
</html>