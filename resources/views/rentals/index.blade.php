<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get Data API Rentals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-5">
        <a href="/rentals/create" class="btn btn-success">Tambah Data</a>
        @if (Session::get('success'))
        <div class="alert alert-success mt-2" role="alert">
            {{Session::get('success')}}
        </div>
        @endif
        @if (Session::get('fail'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('fail')}}
        </div>
    @endif
        <table class="table table-bordered table-warning my-3">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $value)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $value['nama'] }}</td>
                    <td>{{ $value['alamat'] }}</td>
                    <td>{{ $value['type'] }}</td>
                    <td>{{ $value['waktu_jam'] }}</td>
                    <td>{{ $value['total_harga'] }}</td>
                    <td>{{ $value['jam_mulai'] }}</td>
                    <td>{{ $value['supir'] }}</td>
                    <td>{{ $value['jam_selesai'] }}</td>
                    <td>{{ $value['tempat_tujuan'] }}</td>
                    <td>{{ $value['riwayat_perjalanan'] }}</td>
                    <td>{{ $value['status'] }}</td>
                    <td>
                        <a href="/rentals/{{ $value['id'] }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                        <a href="/rentals/edit/{{ $value['id'] }}" class="btn btn-warning"><i class="bi bi-clipboard2-pulse-fill"></i></a>
                        <form action="/rentals/delete/{{ $value['id'] }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form>

                        {{-- <form action="/siswa/delete/{{$value['id']}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
