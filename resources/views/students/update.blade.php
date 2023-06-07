<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <form action="/siswa/update/{{ $students['id'] }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">NIS</label>
              <input type="text" class="form-control" name="nis" id="exampleInputEmail1" value="{{ $students['nis'] }}" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama" value="{{ $students['nama'] }}" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Rombel</label>
                <input type="text" class="form-control" name="rombel" id="exampleInputPassword1" value="{{ $students['rombel'] }}">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Rayon</label>
                <input type="text" class="form-control" name="rayon" value="{{ $students['rayon'] }}" id="exampleInputPassword1">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" value="{{ $students['tgl_lahir'] }}" id="exampleInputPassword1">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
