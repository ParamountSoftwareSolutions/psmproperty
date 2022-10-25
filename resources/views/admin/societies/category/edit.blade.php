@extends('admin.app')
@section('body')
    <div class="col-12">
        <form  method="POST" action="{{url('admin/society/category/add-field', $category->id)}}">
            @csrf
            <div>
                <?php
                    $previousFields = json_decode($category->fields_json_array);
                ?>
                @if($previousFields != null)
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
                            <?php $i= 0; ?>
                            @foreach($previousFields->size as $size)
                                <tr id="row_size_{{$i++}}">
                                    <td><input type="number" name="size_val[]" value="{{$size->value}}" class="form-control"/></td>
                                    <td><input type="text" name="size_unit[]" value="{{$size->unit}}" class="form-control"/></td>
                                    <td>
                                        <button onclick="removeSize('{{$i}}')" type="button" class="btn btn-danger">-</button>
                                    </td>
                                </tr>
                            @endforeach
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
                                <?php $i= 0; ?>
                                @foreach($previousFields->type as $type)
                                    <tr id="row_type_{{$i++}}">
                                        <td><input type="text" name="types[]" value="{{$type->value}}" class="form-control"/></td>
                                        <td><button type="button" onclick="removeType('{{$i}}')" class="btn btn-danger">-</button></td>
                                    </tr>
                                @endforeach
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
                                <?php $i= 0; ?>
                                @foreach($previousFields->premium as $prem)
                                    <tr id="row_premium_{{$i++}}">
                                        <td><input type="text" name="premium[]" value="{{$prem->value}}" class="form-control"/></td>
                                        <td><button type="button" onclick="removePremium('{{$i}}')" class="btn btn-danger">-</button></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td><input type="text" name="premium[]" class="form-control"/></td>
                                    <td>
                                        <button type="button" onclick="addPremium()" class="btn btn-primary">+</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                @endif
            </div>
            <button type="submit" value="Save Changes" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script type="text/javascript">
        removeSize = function(id){
            $('#row_size_'+id).remove();
        }
        removeType = function(id){
            $('#row_type_'+id).remove();
        }
        removePremium=  function(id){
            $('#row_premium_'+id).remove();
        }

    </script>
@endsection
