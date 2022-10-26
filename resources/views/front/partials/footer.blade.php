 <div class="footer__col footer__col--first">
        <footer class="site_footer text-white text-center text-lg-start">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-md-5">
                        <h5 class="footer-heading  "><b>MENU</b></h5>
                        <p>
                            <a href="#!" class="text-white">HOME</a>
                            <a href="#!" class="text-white">PROPERTY</a>
                            <a href="#!" class="text-white">BLOG</a>
                            <a href="#!" class="text-white">ABOUT</a>
                            <a href="#!" class="text-white">AGENTS</a>
                            <a href="#!" class="text-white">ALL</a><br>
                            <a href="#!" class="text-white">FAQ</a>
                            <a href="#!" class="text-white">CONTACT</a>

                        </p>
                        <a href="#!" class="footer-heading"><b>About</b></a><br>
                        <p class="footer-text"><br>RealtySpace is the leader in online real estate and operator of the WK of real estate web site for consumers and real estate professionals. Real Estate of websites captures more than 20 million monthly visitors RealtySpace is the leader in online real estate and operator of the WK of real.</p>
                        <ul class="social-icon">
                            <li>
                                <a href="https://www.facebook.com/lifeatpss/">
                                    <i class="fa fa-facebook" aria-hidden="true">Facebook</i>
                                </a>

                                <a href="https://twitter.com/LifeAtPSS/">
                                    <i class="fa fa-twitter" aria-hidden="true">Twiter</i>
                                </a>

                                <a href="https://www.linkedin.com/company/paramountsoftwaresolutions/about/">
                                    <i class="fa fa-linkedin" aria-hidden="true">LinkedIn</i>
                                </a>

                                <a href="https://www.instagram.com/lifeatpss/?hl=en">
                                    <i class="fa fa-instagram"aria-hidden="true">Instagram</i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 ">
                        <h5 class="footer-heading"><b>CONTACT</b></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="footer-text">Street 5, Imperial Garden Homes Commercial 100 S Paragon City,<br> Cantt, Lahore, Punjab 53200 Pakistan<br>	10am - 7pm mon-fr</p>
                            </div>
                            <div class="col-md-6">
                                <a href="tel:(042) 37184017" class="footer-text"> (042) 37184017</a>
                                <a href="milto:recruitment@paramountsoftwaresolutions.com" class="footer-text">recruitment@paramountsoftwaresolutions.com</a>
                            </div>
                        </div>

                        <a href="#!" class=" footer-heading"><b>FEEDBACK</b></a>

                        <form action="/action_page.php">
                            <div class="form-group pt-3">

                                <input type="email" class="form-control bg-dark text-white " placeholder="Enter email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="txt"></label>
                                <textarea class="form-control bg-dark text-white" rows="5" id="message"></textarea>                            </div>
                            <button type="submit" class="btn border text-white pb-3">SEND</button>
                        </form>
                        </ul>
                    </div>
                    <div class="col-md-3 offset-1 mb-md-0">
                        <h5 class="footer-heading mb-4">LATEST ARTICLE</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class="text-white">Real Estate “Roundup”!</a><p class="footer-text"> TUE - 19 APR - 10:39 AM</p>
                            </li>
                            <li>
                                <a href="#!" class="text-white">We’re ready for the TRID rules!</a> <p class=" footer-text">FRI - 15 APR - 5:07 PM</p>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Real Estate Roundup! </a><p class="footer-text">FRI - 15 APR - 11:32 AM</p>
                            </li>
                            <li>
                                <a href="#" class="btn border footer-text pt-3"><p class="footer-text">MORE ARTICAL</p></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.2);">
                <a class="footer-text" >© 2021 Realtyspace. All rights reserved.</a>
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


                (function ($){
                    $.fn.counter = function() {
                        const $this = $(this),
                            numberFrom = parseInt($this.attr('data-from')),
                            numberTo = parseInt($this.attr('data-to')),
                            delta = numberTo - numberFrom,
                            deltaPositive = delta > 0 ? true : false,
                            time = parseInt($this.attr('data-time')),
                            changeTime = 10;

                        let currentNumber = numberFrom,
                            value = delta*changeTime/time;
                        var interval1;
                        const changeNumber = () => {
                            currentNumber += value;
                            //checks if currentNumber reached numberTo
                            (deltaPositive && currentNumber >= numberTo) || (!deltaPositive &&currentNumber<= numberTo) ? currentNumber=numberTo : currentNumber;
                            this.text(parseInt(currentNumber));
                            currentNumber == numberTo ? clearInterval(interval1) : currentNumber;
                        }

                        interval1 = setInterval(changeNumber,changeTime);
                    }
                }(jQuery));

                $(document).ready(function(){

                    $('.count-up').counter();
                    $('.count1').counter();
                    $('.count2').counter();
                    $('.count3').counter();
                    $('.count4').counter();

                    new WOW().init();

                    setTimeout(function () {
                        $('.count5').counter();
                    }, 3000);
                });
                //    slider Section

            </script>
        </footer>
    </div>
