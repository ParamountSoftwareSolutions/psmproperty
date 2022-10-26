@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table id="dt-table" class="table table-report sm:mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">File Number</th>
                    <th class="whitespace-nowrap">Customer</th>
                    <th class="whitespace-nowrap">Date</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($apartmentDetail->ApartmentSales as $historyData)
                    <tr>
                        <th>{{$historyData->id}}</th>
                        <th>{{$historyData->file_number}}</th>
                        <th>{{$historyData->User->username}}</th>
                        <th>{{$historyData->created_at}}</th>

                        <td>
                            <a href="{{url('agent/apartments/sale/installment', $historyData->id)}}" class="btn btn-success btn-sm">Installment</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('agents.societies.modals.modal_add_installment')
    <script type="text/javascript" language="javascript" >
        var previousAmount  = 0;
        var monthArray = new Array();
        updateAmount = function (agentsId){
            $('#amountToPay').text($('#lastRequiredPay').val());
            $('#sales-id').val(agentsId);
        }
        calcPayments = function(month){
            //calculate month payment and add to previous amount
        }

        $(document).ready(function () {
            $('#dt-table').DataTable();
            $('#dt-table_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#dt-table_wrapper .dataTables_filter').find('input').each(function () {
                const $this = $(this);
                $this.attr("placeholder", "Search");
                $this.removeClass('form-control-sm');
            });
            $('#dt-table_wrapper .dataTables_length').addClass('d-flex flex-row');
            $('#dt-table_wrapper .dataTables_filter').addClass('md-form');
            $('#dt-table_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
            $('#dt-table_wrapper select').addClass('mdb-select');
            $('#dt-table_wrapper .mdb-select').materialSelect();
            $('#dt-table_wrapper .dataTables_filter').find('label').remove();
        });
    </script>
@endsection

