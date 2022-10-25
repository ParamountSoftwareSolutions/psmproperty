<div id="update-property-status-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form id="data-commercial-form" action="{{url('agent/properties/update-status')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="property_id" value="{{$property->id}}"/>
                    <div id="steps-10000" class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="font-medium text-base mt-5">Update Status</div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div id="commercial-basic-info" class="intro-y col-span-12 sm:col-span-12">
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <label for="owner-name">Select Property Status</label><br/>
                                <select name="property-status" class="form-select">
                                    <option value="open">Select Status</option>
                                    <option value="open">Open</option>
                                    <option value="close">Close</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <label for="owner-name">Comments</label><br/>
                                <textarea class="form-control" name="property-comment">
                                </textarea>
                            </div>
                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                <button class="btn btn-primary w-24 ml-2" type="submit" >Update Status</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
