@extends('agents.app')
@section('body')
    <div class="col-12">
        <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
            <div class="intro-y col-span-6 sm:col-span-6">
                <h3 class="text-2xl ">{{$apartment->title}}</h3>
                <br/>
                <p><b>Location: </b> {{$apartment->location}} </p>
                <p><b>Address </b> {{$apartment->address}} </p>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <h3 class="text-2xl pb-5">Flat Details</h3>
        <table id="dt-table" class=" display table">
            <thead>
            <tr>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>#</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Floor</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Area</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Rooms</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Flats</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Down Payment</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Installment(Monthly)</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Total Installments</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Big Installment</b></th>
                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>Actions</b></th>

            </tr>
            </thead>
            <tbody>
                @foreach($apartment->ApartmentDetails as $apartmentDetail)
                    <tr>
                        <td class="text-center">{{$apartmentDetail->id}}</td>
                        <td class="text-center">{{$apartmentDetail->apartment_floor}}</td>
                        <td  class="text-center">{{$apartmentDetail->area}}</td>
                        <td class="text-center">{{$apartmentDetail->total_rooms}}</td>
                        <td class="text-center">{{$apartmentDetail->total_flats}}</td>
                        <td class="text-center">{{$apartmentDetail->down_payment}}</td>
                        <td class="text-center">{{$apartmentDetail->per_month_installment}}</td>
                        <td class="text-center">{{$apartmentDetail->total_installments}}</td>
                        <td class="text-center">{{$apartmentDetail->big_installment_per_year}}</td>
                        <td class="text-center">

                            <a href="javascript:;" data-toggle="modal" onclick="setApartmentDetails('{{$apartmentDetail->id}}','{{$apartmentDetail->down_payment}}', '{{$apartmentDetail->per_month_installment}}','{{$apartmentDetail->total_installments}}', '{{$apartmentDetail->big_installment_per_year}}', '{{$apartmentDetail->big_installment}}' )" data-target="#add-sale-modal" class="btn btn-sm btn-primary">sales
                            </a>
                            <a href="{{url('agent/apartments/sale/history', $apartmentDetail->id)}}" class="btn btn-sm btn-outline-primary">History</a>


                        </td>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        var setApartmentDetails = function(id, downPayment, perMonthInstallment, totalInstallment, bigInstallmentPerYear, bigInstallment){
            $('#apartment_detail_id').val(id);
            $('#label_down_payment').val(downPayment);
            $('#label_total_installment').val(totalInstallment);
            $('#label_monthly_installment').val(perMonthInstallment);
            $('#label_mid_term_installment').val(bigInstallment);
            $('#mid_term_installment_per_year').val(bigInstallmentPerYear);

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
