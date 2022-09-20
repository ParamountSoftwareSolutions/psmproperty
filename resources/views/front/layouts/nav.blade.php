<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand  " href="{{url('/home')}}"></a>
    <P class="navbar-brand " href="http://127.0.0.1:8000/contact-us">
        <p class="image-fit "></p> <img src="{{url('front/img/logo1.png')}}"  alt="Logo"  style="width:80px; height:60px; padding-top:5px; ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
            <li class="nav-item ">
                <a class="nav-link" href="{{url('/')}}"><b>HOME</b></a>
            </li>
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{url('/properties')}}"><b>PROPERTIES</b></a>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{url('/agents')}}"><b>AGENTS</b></a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{url('/faq')}}"><b>FAQ</b></a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{url('/blog')}}"><b>BLOG</b></a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link " href="{{url('/gallery')}}"><b>GALLERY</b></a>--}}
            {{--</li>--}}

            <li class="nav-item">
                <a class="nav-link" href="{{url('/contact')}}"><b>CONTACT</b></a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto pull-right">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/login')}}"><b>Login</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link">|</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/register')}}"><b>Register</b></a>
            </li>
        </ul>
    </div>
</nav>

