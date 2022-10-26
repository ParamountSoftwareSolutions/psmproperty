@extends('auth.includes.app')
@section('content')
    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
            Sign Up
        </h2>
        <div class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center text-white">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
        <form method="POST" action="{{ route('register') }}">
            <div class="intro-x mt-8">
                    @csrf
                    <input type="text" id="userName" onchange="checkUsernameForUser()" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" @error('username') is-invalid @enderror name="username" value="{{ old('username') }}" required placeholder="Username"/>
                    <small id="js-error" class="text-danger" style="display:none"></small>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Email" @error('email') is-invalid @enderror name="last_name" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="number" name="phone_number" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Phone Number" @error('phone_number') is-invalid @enderror name="phone_number" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                    <select name="role" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" required>
                        <option value="agent">Property Agent</option>
                    </select>

                    <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password" @error('password') is-invalid @enderror required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <a href="" class="intro-x text-gray-600 block mt-2 text-xs sm:text-sm">What is a secure password?</a>
                    <input type="password" name="password_confirmation" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password Confirmation">
            </div>
            <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                <label class="cursor-pointer select-none" for="remember-me">I agree to the Property</label>
                <a class="text-theme-1 dark:text-theme-10 ml-1" href="">Privacy Policy</a>.
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                <button type="button" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign in</button>
            </div>
        </form>
    </div>
@endsection
