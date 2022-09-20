@extends('front.layouts.app')
@section('body.content')
    <div class="container-fluid ">
    <div class="row pedding">
        <div class="col-md-9 ">
            <h1 class="text-color"><b>Key Features</b></h1>
            <p class="text-justify">Archives: FAQ</p>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="">
                <p class="accordion_heading text-justify">This is a short list of our most frequently asked questions. For more information about RealtySpace, or if you need support, please call oursupport center.</p>
                <br>
            </div>
        </div>
    </div>
    <div class="row bg-white ">
        <div class="col-md-9 offset-1 section-padding">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                               <h4 class="accordion_heading text-justify1 text-color font-bold">Map & Hierarchical Structure</h4>
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body text-justify1 ">
                          <b class="text-color">  Map & Hierarchical Structure</b><br>

                            Interactive real time blocks/sectors/flat​ tracking
                            Mange different property types such as plots, residential, commercial and reserved
                            Comprehensive map integration with real time coordinate
                            Add color to each property for differentiation
                            Control multiple unit inventories​
                            Monitor statuses of individual units with their complete details
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4  class="accordion_heading text-color" >Clients/Member Management​</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <b class="text-color"> Clients/Member Management​</b><br>

                            Edit and record complete member records i.e pictures, biometric verification, ID card attachments
                            Add additional details i.e next of kin, transaction history, full personal information ​
                            Keep automated records of correspondence with individual members​
                            Ability to define different communication methods
                            View transactions history for each member​
                            Easily attach documents i.e plot/file/flat for each member
                            Auto alerts via custom sms or email alerts
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4  class="accordion_heading text-color"> Real Estate Inventory (File/Plot/Flat) Management​</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p>
                                <b class="text-color">Real Estate Inventory (File/Plot/Flat) Management​</b> <br>
                                View and track individual file of members
                                Handle and configure preference/factors as per requirements​
                                Link files with commission agents for automatic commission calculation​
                                Easily manage preference/balloting/down payments​
                                Track multiple invoices and payments statuses​
                                Flexible installment plans as per customer requirements​
                                Installments integration with accounting and payment against customer file ​
                                Calculate discounts and factor addition
                                Create installment or lump sum plans
                                Auto generate installment plans as needed
                                Color code files & plot inventory for easy identification
                            </p> </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4  class="accordion_heading text-color">Land Record & Town Planning</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-justify1 ">
                            <p>
                                Land Register
                                Complete land record with Mauza, Khattoni, Khasra, and Khewat Information
                                Distribution of land in blocks/sectors and amenities to inventory unit level
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <h4  class="accordion_heading text-color">Token Management</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Token Management</b><br>

                                Token receiving and reservation of unit against token up to validity
                                Token refund, cancellation, and validity extension
                                Token adjustment with a down payment at the time of file creation
                                Installment calculator
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <h4  class="accordion_heading text-color">Investor Management</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Investor Management</b><br>
                                Bulk / Unit-wise reservation of units to an investor
                                Investor installment plan management
                                Investor file management
                                Sales management of investor reserved plots to member
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <h4  class="accordion_heading text-color" >Invoice & Payment / Advance​ Management</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Invoice & Payment / Advance​ Management</b><br>
                                Auto generate installment plans
                                Integrate finance with booking plans to record invoice and payments​
                                Segregate sales and finance functions​
                                Automatically assign customer advances and application of advances to member installments invoices​
                                Update payment history statuses of members
                                Automate custom email alerts and notifications
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <h4  class="accordion_heading text-color">Ownership Transfer & Merger​ Management</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Ownership Transfer & Merger​ Management</b><br>
                                Manage property release process with/between customers
                                Automate accounting reconciliations ​
                                Set file wise approval processes for individual transactions
                                Electric/Bio-metric verification facility for record keeping
                                Capture and manage combine image of both parties for record maintenance
                                Option to merge multiple files into one or different file
                                Record adjustments of the paid amount of different target
                                Record society fee and outstanding fee checks to ensure proper payments of taxes and fee before transfer​
                                View history of ownership contracts ​
                                Facility to cancel or refund file after approval of management

                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingNine">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                <h4  class="accordion_heading text-color">Sales Commission​ Management</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Sales Commission​ Management</b><br>

                                Calculate multiple agents commission for sales​
                                Option to calculate commission based on the invoice or payment​
                                Option to pay commission in installments to agents​
                                Calculate fixed percentage by defining sections or slabs​
                                Apply commission to sales channels or salesmen​
                                Auto calculation and settlement of the commission
                                Auto generation of vendor bills for the commission for each agent ​
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingEleven">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                <h4  class="accordion_heading text-color">Integrated Systems</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Integrated Systems</b><br>

                                Construction Management System
                                Customer Relationship Management
                                Building Management System
                                Rental Management System
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTweleve">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTweleve" aria-expanded="false" aria-controls="collapseTweleve">
                                <h4  class="accordion_heading text-color">BI and Reporting​ ​</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTweleve" class="collapse" aria-labelledby="headingTweleve" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">BI and Reporting​ ​</b><br>

                                Create personalized and intuitive dashboard
                                Access real-time and historical information
                                Drill-downable dashboards tickets​ generation
                                Create  dashboards graphs, tiles using inbuilt templates
                                Real time pivot report creation
                                Share custom reports between two or more users
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThirteen">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                <h4  class="accordion_heading text-color">Value-added Features ​ ​</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Value-added Features ​​</b><br>

                                Late payment surcharge management
                                Monthly maintenance
                                Sales-Commission Management
                                Help Desk
                                Balloting
                                Recovery Management
                                Allotment Management
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFourteen">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                <h4  class="accordion_heading text-color">Security Measures​ ​ ​ ​</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
                        <div class="card-body text-justify1">
                            <p><b class="text-color">Security Measures​ ​ ​​</b><br>

                                Set Two-Factor Authentication Process
                                Encrypt your password for protection
                                Assign customizable user-roles for granular access control
                                ssl & Top-tier third-party security services to store data
                                Daily data backup
                            </p>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingTen">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                <h4 class="accordion_heading text-color">Customer Portal & Website​ Integration</h4>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                        <div class="card-body border text-justify1">
                            <b class="text-color">   Customer Portal & Website​ Integration</b><br>
                            Easily link customer portal to project website
                            Create individual customer portals
                            Manage online application for transfers, merger, cancellation and refunds
                            Ability to link APIs for direct installments payments via credit card​
                            ​Create contact us form for new potential customers​
                            Manage customer feedback and reviews
                        </div>
                </div>
            </div>
        </div>
        </div>
    {{--<div class="col-md-3 pb-5 ">--}}
        {{--<h2 class="card-title"><b>LATEST POST</b></h2>--}}
        {{--<div class="card bg-white ">--}}
            {{--<div class="card-body">--}}
                {{--<h4><a href="#" class="card-links text-black"><b>Real Estate “Roundup”!</b></a></h4>--}}
                {{--<h5><b>TUE - 19 APR - 10:39 AM</b></h5>--}}
                {{--<p class=" widget__text">May new home sales gain 2.2% from April Sales of new single-family houses in May 2015 were at a seasonally…</p>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card bg-white ">--}}
            {{--<div class="card-body">--}}
                {{--<h4><a href="#" class="card-links text-black"><b>We’re ready for the TRID rules!</b></a></h4>--}}
                {{--<h5><b>FRI - 15 APR - 5:07 PM</b></h5>--}}
                {{--<p class=" widget__text">At 5 p.m. EST June 17, the Consumer Financial Protection Bureau issued a statement that the effective date for the…</p>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card bg-white ">--}}
            {{--<div class="card-body">--}}
                {{--<h4><a href="#" class="card-links text-black"><b>Real Estate Roundup</b></a></h4>--}}
                {{--<h5><b>FRI - 15 APR - 11:32 AM</b></h5>--}}
                {{--<p class="widget__text">Active Home-Building Industry Will Lead to More Demand for Warehouse Space Strong consumer spending and the rise in housing construction…</p>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<h2 class="card-title pt-3"><b>ARCHIVES</b></h2>--}}
        {{--<div class="card bg-white">--}}
            {{--<div class="card-body widget__text">--}}
                {{--<h5><a href="#" class="card-link ">April 2016</a></h5>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<h2 class="card-title pt-3"><b>RECENT COMMENTS</b></h2>--}}
        {{--<div class="card bg-white">--}}
            {{--<div class="card-body">--}}
                {{--<h5><a href="#" class="card-link "></a></h5>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--start contact section--}}
        {{--<div class="contact_side pt-5 pb-1" >--}}
            {{--<h2><b>CONTACT</b></h2>--}}
            {{--<p>Our office</p>--}}
        {{--</div>--}}
        {{--<div class="card bg-white">--}}
            {{--<div class="card-body">--}}
                {{--<div class="">80 Franklin Street New York, NY 10013 USA--}}
                    {{--<p><b>08 - 17 mon-fr</b></p>--}}
                    {{--<h5><a href="(042) 37184017" class="card-link">(042) 37184017</a></h5>--}}
                    {{--<h5><a href="info@paramountsoftwaresolutions.com" class="card-link">info@paramountsoftwaresolutions.com</a></h5>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--end contact section--}}
        {{--start feedback section--}}
        {{--<div class="contact_side pt-5 pb-1" >--}}
            {{--<h2><b>FEEDBACK</b></h2>--}}
        {{--</div>--}}
        {{--<div class="card bg-white  ">--}}
            {{--<div class="card-body">--}}
                {{--<form class="form-inline" action="/action_page.php">--}}
                    {{--<div class="form-group pb-4">--}}

                        {{--<input type="email" class="form-control pb-3" id="email" placeholder="E-mail">--}}
                    {{--</div>--}}
                    {{--<div class="form-group pb-2">--}}

                        {{--<textarea class="form-control" rows="5" id="message" placeholder="Message"></textarea>--}}
                        {{--<button type="submit" class="btn border  bg-white ">Send</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--end feedbak section--}}
    </div>
    </div>
@endsection
