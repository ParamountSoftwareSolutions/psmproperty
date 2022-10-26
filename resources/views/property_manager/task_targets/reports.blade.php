@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'All Users List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Targets</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Assign To</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($targets as $target)
                                            @php
                                                switch($target->type){
                                                    case 'lead': $type = 'Leads';break;
                                                    case 'client': $type = 'Client Register';break;
                                                    case 'call': $type = 'Calls';break;
                                                    case 'meeting': $type = 'Meetings';break;
                                                    case 'conversion': $type = 'Conversion';break;
                                                    default: $type = '';
                                                }
                                                $count = Helpers::achieved_count($target->id);
                                                $percentage = round(($count / $target->target) * 100,2);
                                            @endphp
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$target->assign->username ?? ''}}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm px-1 py-0 report_modal" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"> No More Data In this Table.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Connect Call</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="call_id">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                            @error('date')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Start Time</label>
                            <input type="time" id="start_time" name="start_time" class="form-control" required>
                            @error('date')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>End Time</label>
                            <input type="time" name="end_time" class="form-control" required>
                            @error('date')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Comment</label>
                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="10" required></textarea>
                            @error('comment')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('body').on('click','',function () {
                $('#reportModal').show();
            })
        })
    </script>
@endsection
