@extends('society.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leads as $lead)
                    @if($lead->is_client == 0)
                        <tr>
                            <td>{{$lead->id}}</td>
                            <td id="lead_first_name">{{$lead->first_name}}</td>
                            <td id="lead_last_name">{{$lead->last_name}}</td>
                            <td id="lead_phone_number">{{$lead->phone_number}}</td>
                            <td id="lead_address">{{$lead->address}}</td>
                            <td>{{$lead->CreatedBy->username}}</td>
                            <td>
                                <div class="text-center"> <a href="javascript:;" onclick="setValue({{$lead->id}})" data-toggle="modal" data-target="#modal-make-client" class="btn btn-primary btn-sm mr-1">Make Client</a> </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">

        var setValue = function(leadId){
            $('#first_name').val($('#lead_first_name').text());
            $('#last_name').val($('#lead_last_name').text());
            $('#phone_number').val($('#lead_phone_number').text());
            $('#address').val($('#lead_address').text());
            $('#lead-id').val(leadId);

        }

    </script>
@endsection
