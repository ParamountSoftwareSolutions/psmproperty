@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 border-b-2">
            <h1>User Details</h1>
            @if(\App\Helpers\Permission::hasPermission(auth()->user(), 'Sales', 'can_update'))
                <a href="javascript:;" onclick="updateAmount('{{$societySale->id}}')" data-toggle="modal" data-target="#addInstallment-modal"  class="btn btn-sm btn-primary float-right">Update Installment</a>
            @endif
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-6 xxl:col-span-9">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>{{$societySale->SoldTo->username}}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>{{$societySale->SoldTo->email}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-span-6 xxl:col-span-6">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th>Phone Number</th>
                            <th>{{$societySale->SoldTo->phone_number}}</th>
                        </tr>
                        <tr>
                            <th>Installment Status</th>
                            <th>{{count($installmentPaid)}}/{{count($societySale->InstallmentData)}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-span-12 xxl:col-span-9">
            <?php $today_date=date("Y-m-d"); ?>
            <table id="dt-table" class="table table-report sm:mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Installment</th>
                    <th class="whitespace-nowrap">Date</th>
                    <th class="whitespace-nowrap">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; $installmentToPay = 0; ?>
                @foreach($societySale->InstallmentData as $installmentData)
                    <tr>
                        @if($installmentToPay == 0 && $installmentData->StatusName->name == "Not Paid")
                            <?php $installmentToPay = $installmentData->installment_amount; ?>
                            <input type="hidden" id="lastRequiredPay" value="{{$installmentToPay}}"/>
                        @endif

                        <td>{{++$i}}</td>
                        <td>{{$installmentData->installment_amount}}</td>
                        <td>{{$installmentData->due_date}}</td>
                        <td>{{$installmentData->StatusName->name}}</td>
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
        updateAmount = function (societyId){
            $('#amountToPay').text($('#lastRequiredPay').val());
            $('#sales-id').val(societyId);
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

