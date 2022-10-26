@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Expense List')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Income</h4>
                                <a href="{{ route('property_manager.income.create',Helpers::user_login_route()['panel']) }}" class="btn btn-primary"
                                   style="margin-left: auto; display: block;">Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Category</th>
                                            <th>Cost</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($income as $data)
                                            @php
                                                switch($data->category){
                                                    case 'rent' : $cat = 'Rent';break;
                                                    case 'personal_property_rent' : $cat = ' Personal Property Rent';break;
                                                    case 'group_a' : $cat = 'Group A';break;
                                                    case 'group_b' : $cat = 'Group B';break;
                                                    case 'file_income' : $cat = 'File Income';break;
                                                    case 'property_income' : $cat = 'Property Income';break;
                                                    case 'others' : $cat = 'Others';break;
                                                    default:$cat = '';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat }}</td>
                                                <td>{{ $data->cost }}</td>
                                                <td>{{ $data->date }}</td>
                                                <td>
                                                    <a href="{{ route('property_manager.income.edit',['panel'=>Helpers::user_login_route()['panel'],'income'=>$data->id]) }}"
                                                       class="btn btn-primary px-1 py-0" title="Edit">
                                                       <i class="fa fa-edit"></i>

                                                    </a>
                                                    <button type="button" data-url="{{ route('property_manager.income.destroy',['panel'=>Helpers::user_login_route()['panel'],'income'=>$data->id]) }}" data-token="{{ csrf_token() }}" title="Delete" class="btn btn-danger px-1 py-0 deleteBtn">
                                                        <i class="fa fa-trash"></i>
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
@endsection
