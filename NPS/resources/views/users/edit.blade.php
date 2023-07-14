<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <form method="POST" enctype="multipart/form-data" action="{{ route('users.edit', ['id' => $user->id]) }}">


    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
  </div>
  <div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name"  value="{{$user->first_name}}">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password"  value="{{$user->password}}">
  </div>
  <div class="mb-3">
    <label for="Numero" class="form-label">Numero</label>
    <input type="text" class="form-control" id="Numero" name="Numero"  value="{{$user->Numero}}">
  </div>
  <div class="mb-3">
    <label for="adresse" class="form-label">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse"  value="{{$user->adresse}}">
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image"  value="{{$user->image}}">
  </div>
  <div class="mb-3">
    <label for="cin" class="form-label">CIN</label>
    <input type="text" class="form-control" id="cin" name="cin"  value="{{$user->cin}}">
  </div>
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <input type="text" class="form-control" id="role" name="role"  value="{{$user->role}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
