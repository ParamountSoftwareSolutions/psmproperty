@extends('agents.app')
@section('body')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <table class="w-100 table-bordered">
                        <thead>
                        <tr class="theme-color-1">
                            <th>#</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Unit</th>
                            <th>Data
                                <table class="w-100 table-bordered">
                                    <thead>
                                    <tr class="theme-color-2">
                                        <th style="width:25%">Total</th>
                                        <th style="width:25%">Start Number</th>
                                        <th style="width:25%">End Number</th>
                                        <th style="width:25%">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $dataArray = json_decode($agentSocietyData->FileData->data_array);
                        $i=0;
                        ?>

                        @foreach($dataArray as $key => $val)
                            @if(is_object($val))
                                @foreach($val as $nestedKey => $nestedVal)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$nestedKey}}</td>
                                        <td>{{$nestedVal->type}}</td>
                                        <td>{{$nestedVal->size}}</td>
                                        <td>{{$nestedVal->unit}}</td>
                                        <td>
                                            @foreach($nestedVal->files as $innerKey => $innerVal)
                                                <table class="w-100 table-bordered">
                                                    <tr>
                                                        <td style="width:25%" class="text-center">{{$innerVal->total}}</td>
                                                        <td style="width:25%" class="text-center">{{$innerVal->start}}</td>
                                                        <td style="width:25%" class="text-center">{{$innerVal->end}}</td>
                                                        <td style="width:25%" class="text-center">
                                                            <a href="javascript:;" id="#add-sale-modal" data-toggle="modal" data-target="#add-sale-modal" class="btn btn-sm btn-primary">Sales</a>
                                                            <a href="{{url('agent/societies/history', $innerVal->start)}}" class="btn btn-sm text-color">History</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <script type="text/javascript">
       var populateValues = function(catId, type, category, size, unit, start ,end, societyId, categoryDataid){

          $('#society_id').val(societyId)
          $('#society_cat_id').val(categoryDataid)
          $('#plotSize').val(size);


          $('#sales_cat_id').val(catId);
          $('#type').text(type);
          $('#category').text(category);
          $('#size').text(size);
          $('#unit').text(unit);
          $('#file_number').attr('placeholder', start);

          $('#min-val').val(start);
          $('#max-val').val(end);
        }
    </script>
@endsection
