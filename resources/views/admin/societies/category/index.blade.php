@extends('admin.app')
@section('body')
    <div class="col-12">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Parent Category</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>@if($category->Parent != null){{$category->Parent->name}}@else -- @endif</td>
                    <td>{{$category->Status->name}}</td>
                    <td>
                        <button class="btn-rounded-danger btn" onclick="confirmDelete('{{url('admin/society/category/delete', $category->id)}}')"><i data-feather="trash" class="w-4 h-4"></i></button>
                        <a class="btn-rounded-primary btn" href="{{url('admin/society/category/edit', $category->id)}}"><i data-feather="edit" class="w-4 h-4"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        confirmDelete = function(url){
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = url;
            } else {
                // Do nothing!
            }
        }
    </script>
@endsection
