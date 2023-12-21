<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #f0f0f0;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Stripe Payment</h2>
        <form action="{{route('stripe.payment')}}" method="post">
            @csrf
            <div class="mb-3 mt-3 col-md-6">
                <label for="email" class="form-label">User Id:</label>
                <input type="number" class="form-control" id="email" placeholder="Enter User Id" name="user_id" value="{{ old('user_id') }}">
                @error('user_id')
                <p class="text-danger p-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="amount" class="form-label">Amount:</label>
                <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount" value="{{ old('amount') }}">
                @error('amount')
                <p class="text-danger p-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Payment</button>
        </form>
    </div>
</body>
</html>