@extends('society.app')
@section('body')
<form method="POST" action="{{url('society/profile/update')}}" enctype="multipart/form-data">
    <div class="intro-y box lg:mt-5">
            @csrf
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Personal Information</h2>
        </div>
        <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div>
                                <label for="update-profile-form-1" class="form-label">Name</label>
                                <input id="update-profile-form-1" type="text"  name="name" class="form-control" placeholder="Input text" value="{{auth()->user()->username}}">
                            </div>
                        </div>
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="mt-3">
                                <label for="update-profile-form-4" class="form-label">Phone Number</label>
                                <input id="update-profile-form-4" type="text" name="phone_number" class="form-control" placeholder="Input text" value="{{auth()->user()->phone_number}}">
                            </div>
                        </div>
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="mt-3">
                                <label for="update-profile-form-4" class="form-label">E Mail</label>
                                <input id="update-profile-form-4"  type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->email}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">

                            <img id="myimage"  class="rounded-md" alt="" src="{{asset('profile/'.auth()->user()->profile_pic_url)}} ">
                        </div>
                        <div class="mx-auto cursor-pointer relative mt-5">

                            <button type="button" class="btn btn-primary w-full">Change Photo</button>
                            <input type="file" name="profile_image" onchange="onFileSelected(event)" class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="intro-y box mt-5">--}}
            {{--@csrf--}}
        {{--<div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">--}}
            {{--<h2 class="font-medium text-base mr-auto">Business Information</h2>--}}
        {{--</div>--}}
        {{--<div class="p-5">--}}
            {{--<div class="grid grid-cols-12 gap-x-5">--}}
                {{--<div class="col-span-12 xl:col-span-6">--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-7" class="form-label">Owner Name</label>--}}
                        {{--<input id="update-profile-form-7" type="text" class="form-control" name="owner_name" placeholder="Input text" value="{{auth()->user()->Society->owner_name}}" >--}}

                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<label for="update-profile-form-6" class="form-label">Society Name</label>--}}
                        {{--<input id="update-profile-form-6" type="text" class="form-control" name="society_name" disabled="" placeholder="Input text" value=" {{auth()->user()->Society->society_name}}">--}}
                    {{--</div>--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-9" class="form-label">Society_Type ID</label>--}}
                        {{--<input id="update-profile-form-9"  name="society_type_id" type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Society->society_type_id}}">--}}
                    {{--</div>--}}

                {{--</div>--}}
                {{--<div class="col-span-12 xl:col-span-6">--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-11" class="form-label">Noc_Type ID</label>--}}
                        {{--<input id="update-profile-form-11" name="noc_type_id" type="text"  class="form-control" placeholder="Input text" value="{{auth()->user()->Society->noc_type_id}}">--}}
                    {{--</div>--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-11" class="form-label">Area</label>--}}
                        {{--<input id="update-profile-form-11" name="area"  type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Society->area}}">--}}
                    {{--</div>--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-11" class="form-label">Details</label>--}}
                        {{--<input id="update-profile-form-11" name="details" type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Society->details}}">--}}
                    {{--</div>--}}
                    {{--<div class="mt-3">--}}
                        {{--<label for="update-profile-form-11" class="form-label">Status ID</label>--}}
                        {{--<input id="update-profile-form-11" name="status_id" type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Society->status_id}}">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="flex justify-end mt-4 text-center">
                <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
            </div>
        </div>

    {{--</div>--}}
</form>

<script>
    function onFileSelected(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        var imgtag = document.getElementById("myimage");
        imgtag.title = selectedFile.name;

        reader.onload = function(event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }
</script>


@endsection