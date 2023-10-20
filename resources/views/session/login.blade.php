<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Log In</h1>

                        <form method="POST" action="/login">
                            @csrf
                            <div class="mb-3">
                                <x-form.label name="email" />
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required>
                                <x-form.errors name="email" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
