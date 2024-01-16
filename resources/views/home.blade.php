<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    @auth
        <h1>Welcome</h1>
        <form action="/logout" method="POST">
            @csrf
            <button>log Out</button>
        </form>

        <div style="border: 3px solid black">
            <h2>Create new post</h2>
            <form action="create-post" method="Post">
                @csrf
                <input type="text" name="title" placeholder="post title">
                <textarea name='body' placeholder="body content..."></textarea>
                <button>Save post</button>
            </form>
        </div>

        <div style="border: 3px solid black ">
            <h2>all posts</h2>
            @foreach ($posts as $post )
            <div style="background-color: gray" >
                <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
                {{ $post['body'] }}

                <p><a href="/edit-post/{{ $post->id }}">edit</a></p>
                <form action="/delete-post/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
                </form>
            </div>
                
            @endforeach
        
        </div>



    @else
    <div style="border: 3px solid black">
        <h2 >register</h2>
        <form method="POST" action="/register">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>register</button>
        </form>
    </div>
    <div style="border: 3px solid black" >
        <h2>Log in</h2>
        <form method="POST" action="/login">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>log in</button>
        </form>
    </div>


    @endauth


</body>
</html>