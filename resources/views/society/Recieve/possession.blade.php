@extends('society.app')
@section('body')
    <div class="intro-y box overflow-hidden mt-4 bg-white">
        <div class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
            <div class="px-5 py-10 sm:px-20 sm:py-20">
                <img alt="Paramount Property Managements" class="w-6" style="height: 100px; width: 100px;" src="{{url('dist/images/logo11.png')}}">
                <u class="text-danger mt-5"><div class="font-semibold text-3xl text-center text-danger style1">Paramount Property Solutions </div>
                </u>
            </div>
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                <div>
                    <div class=" font-bold text-base text-slate-500">Head Office</div>
                    <div class=" font-semi-bold mt-1">Street 5, Imperial Garden Homes Commercial 100 </div>
                    <div class="font-semi-bold">S Paragon City,Cantt, Lahore, Punjab 53200</div>

                </div>
                <div class="lg:text-right lg:mt-0 lg:ml-auto">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="paraamount Property Solutions" class="rounded-full"> <img id="myimage"  class="rounded-md" alt="" src="{{asset('profile/'.auth()->user()->profile_pic_url)}} ">
                        <div class="absolute  mr-1 flex items-center justify-center bottom-0 right-0 bg-primary rounded-full p-2">
                        </div>
                </div>
                    <div class="font-bold mt-3">REG NO. LHB-II/ 17293</div>
            </div>
            </div>
            <div class="pt-5 pb-5">
                <p CLASS="pt-5 pb-5 text-center text-2xl font-semibold pt-3 text-danger">POSSESSION LETTER PARAGON CITY LAHORE</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table border">
                <thead class="table-dark border">
                <tr class="text-color1 text-center">
                    <th class="whitespace-nowrap text-white"><b>APPLICANT DETAILS</b></th>
                    <th class="whitespace-nowrap text-white">POSSESSION DETAILS</th>

                </tr>
                </thead>
                <tbody class="border pt-5 pb-5 text-center">
                <tr class="border">
                    <td>Name:</td>
                    <td>Address</td>
                </tr>
                <tr class="border">
                    <td>Plot No.</td>
                    <td>Block</td>

                </tr>

                </tbody>
            </table>
        </div>



    </div>
@endsection