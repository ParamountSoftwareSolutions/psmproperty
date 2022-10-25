<div class="footer__col footer__col--first">
    <footer class="site_footer text-white text-center text-lg-start">
        <div class="container-fluid">
            <div class="row pt-4">
                <div class="col-md-5">
                    <h5 class="footer-heading pt-5"><b>MENU</b></h5>
                    <p class="section-padding1 pb-3">
                        <a href="#!" class="text-white">HOME</a>
                        <a href="#!" class="text-white">FAQ</a>
                        <a href="#!" class="text-white">CONTACT</a>

                    </p>
                    <a href="#!" class="pt-5 text-white"><b>About</b></a><br>
                    <p class="text-white section-padding1"><br>RealtySpace is the leader in online real estate and operator of the WK of real estate web site for consumers and real estate professionals. Real Estate of websites captures more than 20 million monthly visitors RealtySpace is the leader in online real estate and operator of the WK of real.</p>
                <ul class="social-icon pt-5 pb-5 section-padding1">
                    <li>
                        <a href="https://www.facebook.com/lifeatpss/">
                            <i class="fa fa-facebook text-white" aria-hidden="true">Facebook</i>
                        </a>

                        <a href="https://twitter.com/LifeAtPSS/">
                            <i class="fa fa-twitter text-white" aria-hidden="true">Twiter</i>
                        </a>

                        <a href="https://www.linkedin.com/company/paramountsoftwaresolutions/about/">
                            <i class="fa fa-linkedin text-white" aria-hidden="true">LinkedIn</i>
                        </a>

                        <a href="https://www.instagram.com/lifeatpss/?hl=en">
                            <i class="fa fa-instagram text-white"aria-hidden="true">Instagram</i>
                        </a>
                    </li>
                </ul>
                </div>

                <div class="col-md-3 ">
                    <h5 class="footer-heading pt-5 "><b>CONTACT</b></h5>
                    <div class="row section-padding1">
                        <div class="col-md-12">
                        <p class="text-white">Street 5, Imperial Garden Homes Commercial 100 S Paragon City,<br> Cantt, Lahore, Punjab 53200 Pakistan<br>	10am - 7pm mon-fr</p>
                            <a href="tel:(042) 37184017" class="text-white"> (042) 37184017</a><br><br>
                            <a href="milto:info@paramountsoftwaresolutions.com" class="text-white">info@paramountsoftwaresolutions.com</a>
                        </div>
                    </div>
                    </ul>
                </div>
                <div class="col-md-3 offset-1 mb-md-0 pt-5 ">
                    <a href="#!" class=" footer-heading"><b>FEEDBACK</b></a>

                    <form action="/action_page.php ">
                        <div class="form-group pt-3 section-padding1 ">

                            <input type="email" class="form-control bg-dark text-white" placeholder="Enter email" id="email">
                        </div>
                        <div class="form-group section-padding1">
                            <label for="txt"></label>
                            <textarea class="form-control bg-dark text-white " rows="5" id="message"></textarea>                            </div>
                        <button type="submit" class=" section-padding11 btn border text-white pb-3 text-centerq " >SEND</button>
                    </form>
            </div>
        </div>
        <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.2);">
            <a class="text-white " >                                                                                         Paramount Software Solutions © 2022 all rights reserved</a>
        </div>

        <!-- Bootstrap Stylesheet -->

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <script src="{{url('front/js/jquery.min.js')}}"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#propertylocation').multiselect({
                    nonSelectedText: 'Any',
                    buttonWidth:'200px',

                });
            });
            $(document).ready(function(){
                $('#propertytype').multiselect({
                    nonSelectedText: 'Any',
                    buttonWidth:'200px',

                });
            });

            $(document).ready(function(){
                $('#propertyfrature').multiselect({
                    nonSelectedText: 'Any',
                    buttonWidth:'200px',

                });
            });
            $(document).ready(function(){
                $('#contracttype').multiselect({
                    nonSelectedText: 'Any',
                    buttonWidth:'200px',
                    backgroundColor:'#0ba',
                });
            });


            $(document).ready(function() {
                    $("#built-up").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 500,
                    from: 0,
                    to: 500,
                    grid: true,
                    width:'20px',
                });
            });
            $(document).ready(function() {
                $("#price").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 500,
                    from: 100,
                    to: 500,
                    grid: true,
                    width:'20px',
                });
            });
            $(document).ready(function() {
                $("#bathroom").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 4,
                    from: 1,
                    to: 4,
                    grid: true,
                    width:'20px',
                });

            });



        </script>
    </footer>
</div>