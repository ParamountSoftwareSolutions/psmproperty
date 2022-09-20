@extends('agents.app')
@section('body')
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"> <img id="myimage"  class="rounded-md" alt="" src="{{asset('profile/'.auth()->user()->profile_pic_url)}} ">
                    <div class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-camera w-4 h-4 text-white"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    </div>
                </div>
                <div class="ml-5">

                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{auth()->user()->username}}</div>
                    <div class="text-slate-500">Agents1</div>

                </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="font-medium text-center lg:text-left "><b>Social Details</b></div>
                <div class="flex flex-col justify-center items-center lg:items-start pt-5">
                    <div class="truncate sm:whitespace-normal flex items-center pt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail w-4 h-4 mr-2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> johnnydepp@left4code.com
                    </div>
                    <div class="truncate sm:whitespace-normal flex items-center pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram w-4 h-4 mr-2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg> Instagram Johnny Depp
                    </div>
                    <div class="truncate sm:whitespace-normal flex items-center pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter w-4 h-4 mr-2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg> Twitter Johnny Depp
                    </div>
                </div>
            </div>

        <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
            <a href="{{url('agent/profile/edit')}}" class="btn btn-secondary block w-40 mx-auto mt-5">Edit Profile's</a>
            <div class="font-medium text-center lg:text-left "><b>Contact Details</b></div>
            <div class="flex flex-col justify-center items-center lg:items-start ">
                <div class="truncate sm:whitespace-normal flex items-center pt-5">
                    <p><b>Name:  &nbsp;</b></p> {{auth()->user()->username}}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center">
                    <p class="text-right"><b>ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p> {{auth()->user()->id}}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center ">
                    <p><b>Mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></p> {{auth()->user()->email}}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center ">
                    <p><b>phone: &nbsp;</b></p> {{auth()->user()->phone_number}}
                </div>
            </div>
        </div>

        </div>
        <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center p-5" role="tablist">
            <li id="dashboard-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4 active" data-tw-target="#dashboard" aria-controls="dashboard" aria-selected="true" role="tab">
                    Dashboard  &nbsp;&nbsp;
                </a>
            </li>
            <li id="account-and-profile-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4" data-tw-target="#account-and-profile" aria-controls="account-and-profile" aria-selected="false" role="tab">
                    Account &amp; Profile &nbsp;&nbsp;
                </a>
            </li>
            <li id="activities-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4" data-tw-target="#activities" aria-controls="activities" aria-selected="false" role="tab">
                    Activities &nbsp;&nbsp;
                </a>
            </li>
            <li id="tasks-tab" class="nav-item" role="presentation">
                <a href="javascript:;" class="nav-link py-4" data-tw-target="#tasks" aria-controls="tasks" aria-selected="false" role="tab">
                    Tasks&nbsp; &nbsp;
                </a>
            </li>
        </ul>
    </div>
    <div class="grid grid-cols-12 gap-6 p-5">


        <!-- BEGIN: Top SOCIETY -->
        <div class="intro-y box col-span-12 lg:col-span-6">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">Top Properties</h2>
                <div class="dropdown ml-auto">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-slate-500"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4 mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add Properties
                                </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings w-4 h-4 mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-5">
                @foreach(auth()->user()->Agent->Properties as $property)
                    <div class="flex flex-col sm:flex-row mt-5">
                        <div class="mr-auto">
                            <?php
                                $propertyData = json_decode($property->data_array);
                            ?>
                            <a href="" class="font-medium">Title:</a><br>
                                <a href="" class="font-medium">Property Type:</a><br>
                                <a href="" class="font-medium">Owner Name:</a><br>
                                <a href="" class="font-medium">Owner Phone Number:</a><br>
                                <a href="" class="font-medium">Area:</a><br>
                                <a href="" class="font-medium">Area Type:</a><br>
                                <a href="" class="font-medium">Location</a><br>
                                <a href="" class="font-medium">Ask Price</a><br>
                                <a href="" class="font-medium">Estimated Price</a><br>
                        </div>
                        <div class="flex">
                            <div class="text-center">
                                <div class="font-medium">{{$propertyData->title}}</div>
                                <div class="font-medium">{{$propertyData->property_type}}</div>
                                <div class="font-medium">{{$propertyData->owner_name}}</div>
                                <div class="font-medium">{{$propertyData->owner_phone}}</div>
                                <div class="font-medium">{{$propertyData->area}}</div>
                                <div class="font-medium">{{$propertyData->area_type}}</div>
                                <div class="font-medium">{{$propertyData->location}}</div>
                                <div class="font-medium">{{$propertyData->ask_price}}</div>
                                <div class="font-medium">{{$propertyData->estimated_price}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- END: Top Categories -->



        <!-- BEGIN: Work In Progress -->
        <div class="intro-y box col-span-12 lg:col-span-6 ">
            <div class="flex items-center px-5 py-5 sm:py-0 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto p-5">Societies</h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-slate-500"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                    </a>
                    <div class="nav nav-tabs dropdown-menu w-40" role="tablist">
                        <ul class="dropdown-content">
                            <li>
                                <a id="work-in-progress-mobile-new-tab" href="javascript:;" data-tw-toggle="tab" data-tw-target="#work-in-progress-new" class="dropdown-item" role="tab" aria-controls="work-in-progress-new" aria-selected="true">New</a>
                            </li>
                            <li>
                                <a id="work-in-progress-mobile-last-week-tab" href="javascript:;" data-tw-toggle="tab" data-tw-target="#work-in-progress-last-week" class="dropdown-item" role="tab" aria-selected="false">Last Week</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav nav-link-tabs w-auto ml-auto hidden sm:flex" role="tablist">
                    <li id="work-in-progress-new-tab" class="nav-item" role="presentation">
                        <a href="javascript:;" class="nav-link py-5 active" data-tw-target="#work-in-progress-new" aria-controls="work-in-progress-new" aria-selected="true" role="tab">
                            New
                        </a>
                    </li>
                    <li id="work-in-progress-last-week-tab" class="nav-item" role="presentation">
                        <a href="javascript:;" class="nav-link py-5" data-tw-target="#work-in-progress-last-week" aria-controls="work-in-progress-last-week" aria-selected="false" role="tab">
                            Last Week
                        </a>
                    </li>
                </ul>
            </div>
            <div class="p-5">
                <div class="tab-content">
                    <div id="work-in-progress-new" class="tab-pane active" role="tabpanel" aria-labelledby="work-in-progress-new-tab">
                        <div>
                            <div class="flex">
                                <div class="mr-auto">Pending Tasks</div>
                                <div>20%</div>
                            </div>
                            <div class="progress h-1 mt-2">
                                <div class="progress-bar w-1/2 bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="flex">
                                <div class="mr-auto">Completed Tasks</div>
                                <div>2 / 20</div>
                            </div>
                            <div class="progress h-1 mt-2">
                                <div class="progress-bar w-1/4 bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="flex">
                                <div class="mr-auto">Tasks In Progress</div>
                                <div>42</div>
                            </div>
                            <div class="progress h-1 mt-2">
                                <div class="progress-bar w-3/4 bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a href="" class="btn btn-secondary block w-40 mx-auto mt-5">View More Details</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Work In Progress -->
        <!-- BEGIN: Daily Sales -->
    </div>


    @endsection