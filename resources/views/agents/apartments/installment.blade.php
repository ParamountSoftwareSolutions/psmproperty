@extends('agents.app')
@section('body')
    @include('agents.apartments.modals.add_installment_modal')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 border-b-2">
            <h1>User Details</h1>
            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Sales', 'can_update'))
               <a href="javascript:;"  data-toggle="modal" data-target="#addInstallment-modal"  class="btn btn-sm btn-primary float-right">Update Installment</a>
            @endif
        </div>
        <div class="col-span-12 xxl:col-span-9">
            <table id="dt-table" class="table table-report sm:mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Amount</th>
                    <th class="whitespace-nowrap">Due Date</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap">Payment Method</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($apartmentSales->InstallmentData as $currentInstallment)
                        <tr>
                            <td>{{$currentInstallment->id}}</td>
                            <td>{{$currentInstallment->installment_amount}}</td>
                            <td>{{$currentInstallment->due_date}}</td>
                            <td>{{$currentInstallment->Status->name}}</td>
                            <td>@if(isset($currentInstallment->payment_mode)){{$currentInstallment->payment_mode}}@else -- @endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
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