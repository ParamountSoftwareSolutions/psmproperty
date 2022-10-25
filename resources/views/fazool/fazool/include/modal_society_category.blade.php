<div id="categorycreateion-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5 pt-0">
            <div class="intro-y box py-10 sm:py-20">
                <form action="{{url('admin/society/category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="steps px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
                        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="input-wizard-1" class="form-label">Category Name</label>
                                <input id="input-wizard-1" name="category_name" type="text" class="form-control" placeholder="Name Of Category">
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
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="input-wizard-1" class="form-label">Sizes</label>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Field Value</th>
                                            <th>Field Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="parent_size">
                                        <tr>
                                            <td><input type="number" name="size_val[]" class="form-control"/></td>
                                            <td><input type="text" name="size_unit[]" class="form-control"/></td>
                                            <td>
                                                <button onclick="addNewSize()" type="button" class="btn btn-primary">+</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="input-wizard-1" class="form-label">Types</label>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Field Value</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="parent_type">
                                    <tr>
                                        <td><input type="text" name="types[]" class="form-control"/></td>
                                        <td>
                                            <button type="button" onclick="addNewType()" class="btn btn-primary">+</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label for="input-wizard-1" class="form-label">Premium Features</label>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Field Value</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="parent_premium">
                                    <tr>
                                        <td><input type="text" name="premium[]" class="form-control"/></td>
                                        <td>
                                            <button type="button" onclick="addPremium()" class="btn btn-primary">+</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
<script type="text/javascript">
    var rowsTypeCount = 0;
    var rowSizeCount = 0;
    var rowPremiumCount = 0;
    addNewSize = function(){
        rowSizeCount += 1;
        var row = '<tr id="row_id_'+rowSizeCount+'"> <td><input type="number" name="size_val[]" class="form-control" /></td>'
         + '<td><input type="text" name="size_unit[]" class="form-control"/></td> <td> <button onclick="addNewSize()" type="button" class="btn btn-primary">+</button>'
         + '<button onclick="removeNewSize('+rowSizeCount+')" type="button" class="btn btn-danger">-</button>'
        +  '</td> </tr>';
        $('#parent_size').append(row);
    }
    removeNewSize = function(id){
        $('#row_id_'+id).remove();
    }

    addNewType = function(){
        rowsTypeCount += 1;
        var row = '<tr id="row_type_'+rowsTypeCount+'"> <td><input  type="text" name="types[]" class="form-control" /></td>'
            + '<td> <button onclick="addNewType()" type="button" class="btn btn-primary">+</button>'
            + '<button onclick="removeNewType('+rowsTypeCount+')" type="button" class="btn btn-danger">-</button>'
            +  '</td> </tr>';
        $('#parent_type').append(row);
    }
    removeNewType = function(id){
        $('#row_type_'+id).remove();
    }

    addPremium = function(){
        rowPremiumCount += 1;
        var row = '<tr id="row_premium_'+rowPremiumCount+'"> <td><input type="text" name="premium[]" class="form-control" /></td>'
            + '<td> <button onclick="addPremium()" type="button" class="btn btn-primary">+</button>'
            + '<button onclick="removeNewPremium('+rowPremiumCount+')" type="button" class="btn btn-danger">-</button>'
            +  '</td> </tr>';
        $('#parent_premium').append(row);
    }

    removeNewPremium = function(id){
        $('#row_premium_'+id).remove();
    }
</script>
