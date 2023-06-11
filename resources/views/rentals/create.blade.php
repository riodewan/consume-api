<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Create API Rentals</title>
</head>
<body>
    <div class="container">
        <div class="card d-block m-auto bg-warning p-4">

            <form action="/rentals/store" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">nama</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">alamat</label>
                    <input type="text" name="alamat" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Type</label>
                    <select name="type" class="form-control">
                        <option value="1-4 orang">1-4 Orang
                        <option value="1-6 orang">1-6 Orang
                      </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">waktu jam</label>
                    <input type="number" name="waktu_jam" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Supir</label>
                    <input type="text" name="supir" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-light">Send</button>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>
