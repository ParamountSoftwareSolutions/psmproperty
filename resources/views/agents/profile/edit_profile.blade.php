@extends('agents.app')
@section('body')
<form method="POST" action="{{url('agent/profile/update')}}" enctype="multipart/form-data">
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
                                <input id="update-profile-form-4" readonly type="text" class="form-control" placeholder="Input text" disabled="" value="{{auth()->user()->email}}">
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


    <div class="intro-y box mt-5">
            @csrf
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Business Information</h2>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 xl:col-span-6">
                    <div class="mt-3">
                        <label for="update-profile-form-7" class="form-label">Business Name</label>
                        <input id="update-profile-form-7" type="text" class="form-control" name="first_name" placeholder="Input text" value="{{auth()->user()->Agent->business_name}}" >
                    </div>
                    <div>
                        <label for="update-profile-form-6" class="form-label">Business E-mail</label>
                        <input id="update-profile-form-6" type="text" class="form-control" disabled="" placeholder="Input text" value="{{auth()->user()->email}}">
                    </div>
                    <div class="mt-3">
                        <label for="update-profile-form-9" class="form-label">Registration Number</label>
                        <input id="update-profile-form-9"  name="registration" type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Agent->registration_number}}">
                    </div>

                </div>
                <div class="col-span-12 xl:col-span-6">
                    <div class="mt-3">
                        <label for="update-profile-form-11" class="form-label">Business Address</label>
                        <input id="update-profile-form-11" name="business_address" type="text"  class="form-control" placeholder="Input text" value="{{auth()->user()->Agent->business_address}}">
                    </div>
                    <div class="mt-3">
                        <label for="update-profile-form-11" class="form-label">Contact Number</label>
                        <input id="update-profile-form-11" name="contact_number"  type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Agent->contact_number}}">
                    </div>
                    <div class="mt-3">
                        <label for="update-profile-form-11" class="form-label">Whatsapp Number</label>
                        <input id="update-profile-form-11" name="whatapps_number" type="text" class="form-control" placeholder="Input text" value="{{auth()->user()->Agent->whatsapp_number}}">
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
            </div>
        </div>

    </div>
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