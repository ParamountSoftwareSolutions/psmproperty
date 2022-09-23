@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <form method="POST" action="{{url('agent/employees/permission')}}">
                        <input type="hidden" value="{{$employee_id}}" name="employee_id"/>
                        @csrf
                        <table class="table table-report sm:mt-2">
                            <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Permission</th>
                                <th class="whitespace-nowrap">Create</th>
                                <th class="whitespace-nowrap">Read</th>
                                <th class="whitespace-nowrap">Update</th>
                                <th class="whitespace-nowrap">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                   @foreach($societySections as $section)
                                       <?php $empPermission =  \App\Models\EmployeePermission::where('employee_id', $employee_id)->where('society_section_id', $section->id)->first();?>
                                       <tr>
                                           <td>{{$section->id}}</td>
                                           <td>{{$section->name}}</td>
                                           <td>
                                               <input @if(isset($empPermission) && $empPermission->can_create == 1) checked @endif type="checkbox" name="permission_create[]" value="{{$section->id}}" />
                                           </td>
                                           <td>
                                               <input @if(isset($empPermission) && $empPermission->can_view == 1) checked @endif type="checkbox" name="permission_read[]" value="{{$section->id}}" />
                                           </td>
                                           <td>
                                               <input @if(isset($empPermission) && $empPermission->can_update == 1) checked @endif type="checkbox" name="permission_update[]" value="{{$section->id}}" />
                                           </td>
                                           <td>
                                               <input @if(isset($empPermission) && $empPermission->can_delete == 1) checked @endif type="checkbox" name="permission_delete[]" value="{{$section->id}}" />
                                           </td>
                                       </tr>
                                   @endforeach
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-primary btn-sm float-right" value="Update Permission">
                    </form>
                </div>
            </div>
        </div>
@endsection
