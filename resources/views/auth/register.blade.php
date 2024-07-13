<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Disting Disting</title>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>
                                <div class="col-md-6">
                                    <input id="Age" type="number" class="form-control @error('Age') is-invalid @enderror" name="age" value="{{ old('email') }}" required autocomplete="email">
                                    @error('Age')

                                            <strong>{{ $message }}</strong>

                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                   <select name="gender" id="gender" class="form-control">
                                       <option value="male" >Male</option>
                                       <option value="female">Female</option>
                                   </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>
                                <div class="col-md-6">
                                <select name="country" id="country" class="form-control">
                                   <option value="bangladesh">Bangladesh</option>
                                   <option value="india">India</option>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
