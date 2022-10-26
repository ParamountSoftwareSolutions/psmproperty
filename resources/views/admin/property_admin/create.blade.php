@extends('admin.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.property_admin.store') }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Add New User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Society Admin Name</label>
                                            <input type="text" class="form-control" required="" name="username">
                                            @error('username')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required="" name="email"
                                                   autocomplete="off">
                                            @error('email')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="number" class="form-control" name="phone_number">
                                            @error('phone_number')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                   autocomplete="off" required>
                                            @error('password')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Building Allows</label>
                                            <input type="number" class="form-control" name="building">
                                            @error('building')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Building Floor Name</label>
                                            <input type="text" data-role="tagsinput" name="floor"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection









{{--
    <!DOCTYPE html>
<html lang="en">


<!-- forms-advanced-form.html  21 Nov 2019 03:54:41 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('panel/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/bundles/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet"
          href="{{asset('panel/assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/bundles/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/bundles/jquery-selectric/selectric.css')}}">
    <link rel="stylesheet"
          href="{{asset('panel/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('panel/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/css/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('panel/assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('panel/assets/img/favicon.ico') }}'/>
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Input Text</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Phone Number (US Format)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control phone-number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password Strength</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control pwstrength"
                                                   data-indicator="pwindicator">
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    $
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Code</label>
                                        <input type="text" class="form-control purchase-code"
                                               placeholder="ASDF-GHIJ-KLMN-OPQR">
                                    </div>
                                    <div class="form-group">
                                        <label>Invoice</label>
                                        <input type="text" class="form-control invoice-input">
                                    </div>
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" class="form-control datemask" placeholder="YYYY/MM/DD">
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Card</label>
                                        <input type="text" class="form-control creditcard">
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Card</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Credit Card</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group">
                                        <label>Tags</label>
                                        <input type="text" class="form-control inputtags">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- General JS Scripts -->
<script src="{{{asset('panel/assets/js/app.min.js')}}}"></script>
<!-- JS Libraies -->
<script src="{{{asset('panel/assets/bundles/cleave-js/dist/cleave.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/cleave-js/dist/addons/cleave-phone.us.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/bootstrap-daterangepicker/daterangepicker.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/select2/dist/js/select2.full.min.js')}}}"></script>
<script src="{{{asset('panel/assets/bundles/jquery-selectric/jquery.selectric.min.js')}}}"></script>
<!-- Page Specific JS File -->
<script src="{{{asset('panel/assets/js/page/forms-advanced-forms.js')}}}"></script>
<!-- Template JS File -->
<script src="{{{asset('panel/assets/js/scripts.js')}}}"></script>
<!-- Custom JS File -->
<script src="{{{asset('panel/assets/js/custom.js')}}}"></script>
</body>


<!-- forms-advanced-form.html  21 Nov 2019 03:55:08 GMT -->
</html>--}}
