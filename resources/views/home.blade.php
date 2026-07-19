<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body> 
  @auth
  <p>Welcome</p>
  <form action="/logout" method="POST">
    @csrf
    <button>Log out</button>
  </form>
  <div style="border: 3px solid black">
    <h2>Create a New Post</h2>
    <form action="/create-post" method="POST">
      @csrf
      <input type="text" name="title" placeholder="Post Title">
      <textarea name="body" placeholder="Body Content"></textarea>
      <button>Save Post</button>
    </form>
  </div>
  <div style="border: 3px solid black">
    <h2>All Posts</h2>
    @foreach ($posts as $post)
    <div style="background-color: gray; padding: 10px; margin: 10px;">
      <h3>{{ $post['title'] }}</h3>
      <p>{{ $post['body'] }}</p>
    </div>
      
    @endforeach
  </div>
  @else
  <div style="border: 3px solid black">
    <h2>Register</h2>
    <form action="/register" method="POST">
      @csrf
      <input type="text" placeholder="name" name="name">
      <input type="text" placeholder="email" name="email">
      <input type="password" placeholder="password" name="password">
      <button>Register</button>
    </form>
  </div>
  {{-- login section  --}}
  <div style="border: 3px solid black">
    <h2>Login</h2>
    <form action="/login" method="POST">
      @csrf
      <input type="text" placeholder="name" name="loginname">
      <input type="password" placeholder="password" name="loginpassword">
      <button>Log In</button>
    </form>
  </div>
  @endauth
</body>
</html>