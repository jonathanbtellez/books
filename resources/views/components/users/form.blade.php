<div class="row mb-3">
    <label for="number_id" class="col-md-4 col-form-label text-md-end">{{ __('Identification') }}</label>
    <div class="col-md-6">
        <input id="number_id" type="text" class="form-control @error('number_id') is-invalid @enderror" name="number_id"
            value="{{ $user->number_id ?? old('number_id') }}" required autofocus>

        @error('number_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

    <div class="col-md-6">
        <select class="form-select @error('role') is-invalid @enderror" name="role">
            <option selected>{{ 'Choice a role' }}</option>
            @foreach ($roles as $role)
                <option class="text-capitalize" value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>
        @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last name') }}</label>
    <div class="col-md-6">
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
            name="last_name" value="{{ $user->last_name ?? old('last_name') }}" required autofocus>

        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ $user->email ?? old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div>

<div class="row mb-0">
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">
            {{ $slot }}
        </button>
    </div>
</div>
