<div id="provincecreation-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form action="{{url('admin/location/province')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Province Name</label>
                                <input id="input-wizard-1" name="province_name" type="text" class="form-control" placeholder="Name Of Province">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Status</label>
                                <select id="input-wizard-3" name="status_id" class="form-select">
                                    <option value="-1">Select Type Of Status</option>
                                    @foreach($status[0]->status as $stat)
                                        <option value="{{$stat->id}}">{{$stat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-24 ml-2"  type="submit">Add Status</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
