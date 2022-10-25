@extends('society.app')
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
                                        <th style="width:30%">Total</th>
                                        <th style="width:30%">Start Number</th>
                                        <th style="width:30%">End Number</th>
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
                                                        <td style="width:30%" class="text-center">{{$innerVal->total}}</td>
                                                        <td style="width:30%" class="text-center">{{$innerVal->start}}</td>
                                                        <td style="width:30%" class="text-center">{{$innerVal->end}}</td>
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
@endsection
