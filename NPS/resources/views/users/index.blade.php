<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</head>

<body>

    <div class="window">
        <header class="window-header">
            <nav class="navigation" style="width:127px">
                <div class="navigation-top">
                    <a href="products" class="navigation-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 9.5L12 4L21 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M19 13V19.4C19 19.7314 18.7314 20 18.4 20H5.6C5.26863 20 5 19.7314 5 19.4V13"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="navigation-item-title">My Products</span>
                    </a>
                    <a href="users.html" class="navigation-item active">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.6 3H20.4C20.7314 3 21 3.26863 21 3.6V20.4C21 20.7314 20.7314 21 20.4 21H3.6C3.26863 21 3 20.7314 3 20.4V3.6C3 3.26863 3.26863 3 3.6 3Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path d="M9.75 9.75V21" stroke="currentColor" stroke-width="1.5" />
                            <path d="M3 9.75H21" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <span class="navigation-item-title">All Users</span>
                    </a>
                </div>
            </nav>
        </header>

        <main class="window-main">
            <div class="window-main-body">
                <div class="window-main-body-right">
                    <a href="users/create">
                        <button>Create</button>
                    </a>
                    <section class="settings-section">
                        <div class="row">
                            @foreach ($users as $user)
                            <div class="card col-4">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$user->name}}</h5>
                                    <p class="card-text">{{$user->email}}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">{{$user->created_at}}</small>
                                    <a href="users/{{$user->id}}/update" class="btn btn-primary">Update</a>
                                    <a href="users/{{$user->id}}/delete"><button class="btn btn-danger">Delete</button></a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</body>

</html>