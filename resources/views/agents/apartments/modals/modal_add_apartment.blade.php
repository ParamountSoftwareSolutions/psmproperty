<div id="add-apartment-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <div class="px-5 mt-10">
                    <div class="font-bold text-center text-2xl">Add New Apartment Building</div>
                    <div class="text-gray-600 text-center mt-2">To start off, please provide correct information.</div>
                </div>
                <form id="society-form" action="{{url('agent/apartments/add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="apartment_title">Title</label>
                            <input type="text" class="form-control" name="apartment_title" id="apartment_title" placeholder="Title of Apartment"/>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" id="location" placeholder="Location of Building"/>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address of Building"/>
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="picture">Apartment Picture</label>
                            <input type="file" class="form-control" name="picture" id="picture"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <button class="btn btn-primary w-24 ml-2" type="button" onclick="gotoStep('submit', 'society')">Add New Apartments</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
