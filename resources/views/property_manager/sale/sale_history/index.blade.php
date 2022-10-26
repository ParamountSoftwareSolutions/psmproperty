@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Clients')
@section('style')
    <style>
        .dropdown-item {
            cursor: pointer;
        }

        .badge {
            color: white !important;
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-right align-items-center">
                                <h4>Sale History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Building</th>
                                            <th>Unit id</th>
                                            <th>From Client</th>
                                            <th>To Client</th>
                                            <th>Sales Person</th>
                                            <th>Transfer Fee</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            {{--<th>Action</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($sale_history as $data)
                                            <tr>
                                                @php($transfer = json_decode($data->data))
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ($data->building_sale->floor_detail !== null) ? $data->building_sale->floor_detail->building->name : 'N/A' }}</td>
                                                <td>{{ ($data->building_sale->floor_detail !== null) ? $data->building_sale->floor_detail->unit_id : 'N/A' }}</td>
                                                <td>{{ $data->user($transfer->from)->username }}</td>
                                                <td>{{ $data->user($transfer->to)->username }}</td>
                                                <td>{{ $data->user($transfer->sale_person)->username ?? '' }}</td>
                                                <td>{{ $transfer->fee }} RS</td>
                                                <td>{{ $transfer->status }}</td>
                                                <td>{{ $transfer->date }}</td>
                                                {{--<td>
                                                    <a href="{{ route('property_manager.sale.client.edit', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                       class="btn btn-primary" title="Edit">
                                                        Edit

                                                    </a>
                                                    <a href="{{ route('property_manager.sale.client.show', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                       class="btn btn-primary" title="Detail">
                                                        View
                                                    </a>
                                                    @if (Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'employee' && Illuminate\Support\Facades\Auth::user()->roles[0]->name !== 'sale_manager')
                                                        <form
                                                            action="{{ route('property_manager.sale.client.destroy', ['client' => $data->id, 'panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}"
                                                            method="post" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Delete" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>--}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9"> No More Data In this Table.</td>
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
    <!-- basic modal -->
    {{--<form action="" method="POST" id="statusForm">
        @csrf
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="status" id="form_status">
                        <input type="hidden" name="id" id="form_id">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" required>
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>--}}
@endsection
@section('script')
    {{--<script>
        $(document).ready(function () {
            $('.sales_person').click(function () {
                $('input[name="sales_person"]').val($(this).attr('data-id'));
                submit();

            });
            $('.status').click(function () {
                $('input[name="status"]').val($(this).attr('data-value'));
                submit();

            });
            $('.filter_date').click(function () {
                $('input[name="filter_date"]').val($(this).attr('data-value'));
                submit();

            });

            function submit() {
                $('.filter_form').submit();
            }


            $('.change_status').on('click', function () {
                var status = $(this).attr('data-value');
                var id = $(this).attr('data-id');
                $('#form_status').val(status);
                $('#form_id').val(id);
                $('#statusForm').attr('action', "{{route('property_manager.sale.client.change_status', ['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']])}}");
                $('#statusModal').modal('show');

            });
        });
    </script>--}}
@endsection

