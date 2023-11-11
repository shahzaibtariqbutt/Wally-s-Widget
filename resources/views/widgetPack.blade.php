<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Packs</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('calculatePacks') }}" method="post" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="orderSize" class="form-label">Enter the number of widgets:</label>
                    <input type="number" name="order" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Calculate Packs</button>
            </form>
            @isset($packs)
                <div class="alert alert-success">
                    <h2 class="mb-3">For the order of {{$order}}:</h2>
                    <ul class="list-group">
                        @foreach($packs as $key => $pack)
                            <li class="list-group-item">{{ $pack }} {{ $pack > 1 ? 'packs' : 'pack' }} of {{ $key }} widgets ({{$key}} x {{$pack}})</li>
                        @endforeach
                    </ul>
                </div>
            @endisset
        </div>
    </div>
    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eIw+TtW/6U6jltoDTKC0YciHzpV4tEUaR08E9CZ9N3bGOzI2h0EKDreZM5n5oX0F" crossorigin="anonymous"></script>
</body>
</html>