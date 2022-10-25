<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">REGISTER </h3>
                            <div class="form-group">
                                <label for="name" class="text-info"><b>Name</b></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info"><b>E-mail</b></label><br>
                                <input type="text" name="email" id="email" class="form-control" placeholder="E-Mail">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"><b>Password</b></label><br>
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"><b>Confirm Password</b></label><br>
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="{{url('/login')}}" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
