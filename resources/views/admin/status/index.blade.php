@extends('admin.app')
@section('body')
    <div class="col-12">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($status[0]->status as $stat)
                <tr>
                    <td>{{$stat->id}}</td>
                    <td>{{$stat->name}}</td>
                    <td>
                        <button class="btn-rounded-danger btn" onclick="confirmDelete('{{url('admin/status/delete', $stat->id)}}')"><i data-feather="trash" class="w-4 h-4"></i></button>
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
