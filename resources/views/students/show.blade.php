<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex justify-content-center align-items-center container mt-5">
        <form>
            <fieldset disabled>
              <legend>DATA SISWA {{ $students['nama'] }}</legend>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">NIS</label>
                <input type="text" id="disabledTextInput" class="form-control" value="{{ $students['nis'] }}">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Nama</label>
                <input type="text" id="disabledTextInput" class="form-control" value="{{ $students['nama'] }}">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Rombel</label>
                <input type="text" id="disabledTextInput" class="form-control" value="{{ $students['rombel'] }}">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Rayon</label>
                <input type="text" id="disabledTextInput" class="form-control" value="{{ $students['rayon'] }}">
              </div>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Tanggal Lahir</label>
                <input type="date" id="disabledTextInput" class="form-control" value="{{ $students['tgl_lahir'] }}">
              </div>
            </fieldset>
            <a href="/siswa" class="btn btn-primary">Back</a>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
