@extends('society_admin.app')
@section('body')
    <div class="grid grid-cols-12 gap-6 mt-5 pb-5">
        @foreach(auth()->user()->societies as $society)
        <div class="col-span-12 sm:col-span-6  xl:col-span-3 intro-y">
            <div class="report-box zoom-in ">
                <div class="box pr-5 mt-4 pl-5 bg-dark">
                    <img class="card-img-top" src="{{'/dist/images/logo3.jpg'}}" alt="Card image cap" style="width: 250px;";>
                         {{--SECTIONS
                         Hide the ID in the reasion there is no need this sections in this moments.--}}
                    {{--<div class="text-3xl font-medium leading-8 mt-4 mb-2 ">#: &nbsp;{{$society->id}} </div>--}}
                         {{--End hide Id SECTIONS--}}
                    <div class="text-base text-slate-500 pb-2 pt-2">Name: &nbsp; {{$society->society_name}}</div>
                    <button class="btn-rounded-danger btn"><i data-feather="trash" class="w-4 h-4"></i></button>
                    <a href="{{url('societyAdmin/details', $society->id)}}" class="btn-rounded-primary btn"><i data-feather="edit" class="w-4 h-4"></i></a>
                    <a href="{{url('societyAdmin/view-society', $society->id)}}" class="btn-rounded-success btn"><i data-feather="eye" class="w-4 h-4"></i></a>
                </div>
            </div>
        </div>
            @endforeach
    </div>
@endsection
