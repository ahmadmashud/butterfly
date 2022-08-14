_
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body style="background-color: #374f65;">
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if(isset($error))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        </div>
        @endif
        <div class="row align-items-center g-lg-5 py-5">
            <h1 class="text-center display-4 fw-bold lh-1 mb-3" style="color:white">Login</h1>
            <div class="col-md-10 mx-auto col-lg-7">


                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/login">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="user" type="text" class="form-control" id="user" placeholder="id">
                        <label for="user">User</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control" id="password" placeholder="password">
                        <label for="password">Password</label>
                    </div>
                    <button style="background-color: #253544;" class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>