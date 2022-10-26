
{{--@extends('property_manager.layout.app')--}}
{{--@section('title', 'Property')--}}
{{--@section('style')--}}
{{--    <script>--}}
{{--        window.fbAsyncInit = function () {--}}
{{--            FB.init({--}}
{{--                appId: '760962731817972',--}}
{{--                xfbml: true,--}}
{{--                version: 'v14.0'--}}
{{--            });--}}
{{--            FB.AppEvents.logPageView();--}}
{{--        };--}}

{{--        (function (d, s, id) {--}}
{{--            var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--            if (d.getElementById(id)) {--}}
{{--                return;--}}
{{--            }--}}
{{--            js = d.createElement(s);--}}
{{--            js.id = id;--}}
{{--            js.src = "https://connect.facebook.net/en_US/sdk.js";--}}
{{--            fjs.parentNode.insertBefore(js, fjs);--}}
{{--        }(document, 'script', 'facebook-jssdk'));--}}

{{--        function subscribeApp(page_id, page_access_token) {--}}

{{--            console.log('Subscribing page to app! ' + page_id);--}}
{{--            FB.api(--}}
{{--                '/' + page_id + '/subscribed_apps',--}}
{{--                'post',--}}
{{--                {access_token: page_access_token, subscribed_fields: ['leadgen']},--}}
{{--                function(response) {--}}
{{--                    console.log('Successfully subscribed page', response);--}}
{{--                }--}}
{{--            );--}}
{{--        }--}}

{{--        function myFacebookLogin() {--}}
{{--            /*FB.getLoginStatus(function(response) {--}}
{{--                statusChangeCallback(response);--}}
{{--            });*/--}}
{{--            FB.login(function (response) {--}}
{{--                //var check = response);--}}
{{--                console.log(response);--}}
{{--                FB.api('/me/accounts', function (response) {--}}
{{--                    console.log(response);--}}
{{--                    var pages = response.data;--}}
{{--                    console.log("new data here",pages);--}}
{{--                    var ul = document.getElementById('list');--}}
{{--                    for (var i = 0, len = pages.length; i < len; i++) {--}}
{{--                        var page = pages[i];--}}
{{--                        var li = document.createElement('li');--}}
{{--                        var a = document.createElement('a');--}}
{{--                        a.href = "#";--}}
{{--                        a.onclick = subscribeApp.bind(this, page.id, page.access_token);--}}
{{--                        a.innerHTML = page.name;--}}
{{--                        li.appendChild(a);--}}
{{--                        //li.innerHTML = page.name;--}}
{{--                        ul.appendChild(li);--}}
{{--                    }--}}
{{--                })--}}
{{--            }, {scope: ['pages_show_list', 'leads_retrieval',  'pages_manage_metadata', 'pages_read_engagement']});--}}
{{--        }--}}
{{--        // 'pages_manage_ads',--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div class="main-content">--}}
{{--        <section class="section">--}}
{{--            <div class="section-body">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header d-flex justify-content-between align-items-center">--}}
{{--                                <h4>Property</h4>--}}
{{--                                --}}{{--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">--}}
{{--                                </fb:login-button>--}}

{{--                                <button class="btn btn-primary" onclick="myFacebookLogin()" style="margin-left: auto; display: block;">Add New</button>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <ul id="list"></ul>--}}

{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-striped" id="table-1">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="text-center">#</th>--}}
{{--                                            <th>Title</th>--}}
{{--                                            <th>Size</th>--}}
{{--                                            <th>Address</th>--}}
{{--                                            <th>Price</th>--}}
{{--                                            <th>Date</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <div id="status">--}}
{{--                                        </div>--}}
{{--                                        --}}{{--@forelse($property as $data)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $loop->iteration }}</td>--}}
{{--                                                <td>{{ $data->title }}</td>--}}
{{--                                                <td>{{ $data->size }}</td>--}}
{{--                                                <td>{{ $data->address }}</td>--}}
{{--                                                <td>{{ $data->price }} RS</td>--}}
{{--                                                <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{ route('property_manager.property.edit',$data->id) }}"--}}
{{--                                                       class="btn btn-primary" title="Create And Update Details">--}}
{{--                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--                                                             height="24"--}}
{{--                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                             stroke-width="2" stroke-linecap="round"--}}
{{--                                                             stroke-linejoin="round" class="feather feather-edit">--}}
{{--                                                            <path--}}
{{--                                                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>--}}
{{--                                                            <path--}}
{{--                                                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>--}}
{{--                                                        </svg>--}}

{{--                                                    </a>--}}
{{--                                                    <form--}}
{{--                                                        action="{{ route('property_manager.property.destroy',$data->id) }}"--}}
{{--                                                        method="post" style="display: inline-block;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="submit" title="Delete" class="btn btn-danger">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"--}}
{{--                                                                 height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                                                                 stroke="currentColor" stroke-width="2"--}}
{{--                                                                 stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                 class="feather feather-trash-2">--}}
{{--                                                                <polyline points="3 6 5 6 21 6"></polyline>--}}
{{--                                                                <path--}}
{{--                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>--}}
{{--                                                                <line x1="10" y1="11" x2="10" y2="17"></line>--}}
{{--                                                                <line x1="14" y1="11" x2="14" y2="17"></line>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @empty--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="7"> No More Data In this Table.</td>--}}
{{--                                            </tr>--}}
{{--                                        @endforelse--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('script')--}}
{{--    --}}{{--<script>--}}

{{--        function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().--}}
{{--            console.log('statusChangeCallback');--}}
{{--            console.log(response);                   // The current login status of the person.--}}
{{--            if (response.status === 'connected') {   // Logged into your webpage and Facebook.--}}
{{--                testAPI();--}}
{{--            } else {                                 // Not logged into your webpage or we are unable to tell.--}}
{{--                document.getElementById('status').innerHTML = 'Please log ' +--}}
{{--                    'into this webpage.';--}}
{{--            }--}}
{{--        }--}}


{{--        function checkLoginState() {               // Called when a person is finished with the Login Button.--}}
{{--            FB.getLoginStatus(function (response) {   // See the onlogin handler--}}
{{--                statusChangeCallback(response);--}}
{{--            });--}}
{{--        }--}}


{{--        window.fbAsyncInit = function () {--}}
{{--            FB.init({--}}
{{--                appId: '760962731817972',--}}
{{--                cookie: true,                     // Enable cookies to allow the server to access the session.--}}
{{--                xfbml: true,                     // Parse social plugins on this webpage.--}}
{{--                version: 'v14.0'           // Use this Graph API version for this call.--}}
{{--            });--}}


{{--            FB.getLoginStatus(function (response) {   // Called after the JS SDK has been initialized.--}}
{{--                statusChangeCallback(response);        // Returns the login status.--}}
{{--            });--}}
{{--        };--}}

{{--        function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.--}}
{{--            console.log('Welcome!  Fetching your information.... ');--}}
{{--            FB.api('/me', function (response) {--}}
{{--                console.log('Successful login for: ' + response);--}}
{{--                document.getElementById('status').innerHTML =--}}
{{--                    'Thanks for logging in, ' + response + '!';--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}


{{--    <!-- The JS SDK Login Button -->--}}





{{--    <!-- Load the JS SDK asynchronously -->--}}
{{--    --}}{{--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>--}}

{{--@endsection--}}

@extends('property_manager.layout.app')
@section('title', 'Property')
@section('style')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '760962731817972',
                xfbml: true,
                version: 'v14.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function subscribeApp(page_id, page_access_token) {
            console.log('Successfully page acess token', page_access_token);
            FB.api(
                '/' + page_id + '/subscribed_apps',
                'post', {
                    access_token: page_access_token,
                    subscribed_fields: ['leadgen']
                },
                function(response) {
                    console.log('Successfully subscribed page', response);
                }
            );
        }

        function myFacebookLogin() {
            /*FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });*/
            FB.login(function(response) {
                //var check = response);
                console.log(response);
                FB.api('/me/accounts', function(response) {
                    console.log(response);
                    var pages = response.data;
                    console.log("new data here", pages);
                    var ul = document.getElementById('list');
                    for (var i = 0, len = pages.length; i < len; i++) {
                        var page = pages[i];
                        var access = page.access_token;
                        var page_id = "webhook/leads_form/" + page.id + "/" + access;
                        var li = document.createElement('li');
                        li.className = "list-group-item";
                        var a = document.createElement('a');
                        a.href = page_id;
                        a.onclick = subscribeApp.bind(this, page.id, page.access_token);
                        a.innerHTML = page.name;
                        li.appendChild(a);
                        //li.innerHTML = page.name;
                        ul.appendChild(li);
                    }
                })
            }, {
                scope: ['pages_show_list', 'leads_retrieval', 'pages_manage_metadata', 'pages_read_engagement']
            });
        }
        // 'pages_manage_ads',
    </script>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Facebook Pages</h4>
                                {{--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                    </fb:login-button>--}}

                                <button class="btn btn-primary" onclick="myFacebookLogin()" style="margin-left: auto; display: block;">Login Facebook</button>
                            </div>
                            <div class="card-body">
                                <ul class="list-group" id="list"></ul>
                            <!-- <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Title</th>
                                            <th>Size</th>
                                            <th>Address</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div id="status"></div>
                                        {{--@forelse($property as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->size }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->price }} RS</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('property_manager.property.edit',$data->id) }}" class="btn btn-primary" title="Create And Update Details">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>

                                            </a>
                                            <form action="{{ route('property_manager.property.destroy',$data->id) }}" method="post" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete" class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7"> No More Data In this Table.</td>
                                        </tr>
                                        @endforelse--}}
                                </tbody>
                            </table>
                        </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    {{--<script>
            function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
                console.log('statusChangeCallback');
                console.log(response);                   // The current login status of the person.
                if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                    testAPI();
                } else {                                 // Not logged into your webpage or we are unable to tell.
                    document.getElementById('status').innerHTML = 'Please log ' +
                        'into this webpage.';
                }
            }


            function checkLoginState() {               // Called when a person is finished with the Login Button.
                FB.getLoginStatus(function (response) {   // See the onlogin handler
                    statusChangeCallback(response);
                });
            }


            window.fbAsyncInit = function () {
                FB.init({
                    appId: '760962731817972',
                    cookie: true,                     // Enable cookies to allow the server to access the session.
                    xfbml: true,                     // Parse social plugins on this webpage.
                    version: 'v14.0'           // Use this Graph API version for this call.
                });


                FB.getLoginStatus(function (response) {   // Called after the JS SDK has been initialized.
                    statusChangeCallback(response);        // Returns the login status.
                });
            };

            function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function (response) {
                    console.log('Successful login for: ' + response);
                    document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response + '!';
                });
            }

        </script>--}}


    <!-- The JS SDK Login Button -->





    <!-- Load the JS SDK asynchronously -->
    {{--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>--}}

@endsection
