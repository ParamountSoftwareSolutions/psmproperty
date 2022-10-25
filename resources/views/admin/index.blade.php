@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Societies</h5>
                                            <h2 class="mb-3 font-18">{{ $societies }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('panel/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Block Societies</h5>
                                            <h2 class="mb-3 font-18">{{ $block_societies }}</h2>
                                            {{--<p class="mb-0"><span class="col-green">10%</span> Increase</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('panel/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Society Admin</h5>
                                            <h2 class="mb-3 font-18">{{ $society_admin }}</h2>
                                            {{--<p class="mb-0"><span class="col-orange">09%</span> Decrease</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('panel/assets/img/banner/2.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">New Project</h5>
                                            <h2 class="mb-3 font-18">128</h2>
                                            <p class="mb-0"><span class="col-green">18%</span>
                                                Increase</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('panel/assets/img/banner/3.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Revenue</h5>
                                            <h2 class="mb-3 font-18">$48,697</h2>
                                            <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('panel/assets/img/banner/4.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Revenue chart</h4>
                            <div class="card-header-action">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                        <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                            Delete</a>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div id="chart1"></div>
                                    <div class="row mb-0">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                                                                        class="col-green"></i>
                                                    <h5 class="m-b-0">$675</h5>
                                                    <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                                                                                        class="col-orange"></i>
                                                    <h5 class="m-b-0">$1,587</h5>
                                                    <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <div class="list-inline text-center">
                                                <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                                                                        class="col-green"></i>
                                                    <h5 class="mb-0 m-b-0">$45,965</h5>
                                                    <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row mt-5">
                                        <div class="col-7 col-xl-7 mb-3">Total customers</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">8,257</span>
                                            <sup class="col-green">+09%</sup>
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Total Income</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">$9,857</span>
                                            <sup class="text-danger">-18%</sup>
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Project completed</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">28</span>
                                            <sup class="col-green">+16%</sup>
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">Total expense</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">$6,287</span>
                                            <sup class="col-green">+09%</sup>
                                        </div>
                                        <div class="col-7 col-xl-7 mb-3">New Customers</div>
                                        <div class="col-5 col-xl-5 mb-3">
                                            <span class="text-big">684</span>
                                            <sup class="col-green">+22%</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chart</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart4" class="chartsh"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chart</h4>
                        </div>
                        <div class="card-body">
                            <div class="summary">
                                <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                                    <div id="chart3" class="chartsh"></div>
                                </div>
                                <div data-tab-group="summary-tab" id="summary-text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Chart</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart2" class="chartsh"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Assign Task Table</h4>
                            <div class="card-header-form">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center">
                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                       class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Task Name</th>
                                        <th>Members</th>
                                        <th>Task Status</th>
                                        <th>Assigh Date</th>
                                        <th>Due Date</th>
                                        <th>Priority</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Create a mobile app</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-8.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Wildan Ahdian"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-9.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-10.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Sarah Smith"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">50%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-success" data-width="50%"></div>
                                            </div>
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>2019-05-28</td>
                                        <td>
                                            <div class="badge badge-success">Low</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-2">
                                                <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Redesign homepage</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-1.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Wildan Ahdian"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-2.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">40%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-danger" data-width="40%"></div>
                                            </div>
                                        </td>
                                        <td>2017-07-14</td>
                                        <td>2018-07-21</td>
                                        <td>
                                            <div class="badge badge-danger">High</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-3">
                                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Backup database</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-3.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Wildan Ahdian"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-4.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-5.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Sarah Smith"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+3</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">55%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-purple" data-width="55%"></div>
                                            </div>
                                        </td>
                                        <td>2019-07-25</td>
                                        <td>2019-08-17</td>
                                        <td>
                                            <div class="badge badge-info">Average</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-4">
                                                <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Android App</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-7.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-8.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Sarah Smith"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">70%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar" data-width="70%"></div>
                                            </div>
                                        </td>
                                        <td>2018-04-15</td>
                                        <td>2019-07-19</td>
                                        <td>
                                            <div class="badge badge-success">Low</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-5">
                                                <label for="checkbox-5" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Logo Design</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-9.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Wildan Ahdian"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-10.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-2.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Sarah Smith"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+2</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">45%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-cyan" data-width="45%"></div>
                                            </div>
                                        </td>
                                        <td>2017-02-24</td>
                                        <td>2018-09-06</td>
                                        <td>
                                            <div class="badge badge-danger">High</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="p-0 text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                                       id="checkbox-6">
                                                <label for="checkbox-6" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Ecommerce website</td>
                                        <td class="text-truncate">
                                            <ul class="list-unstyled order-list m-b-0 m-b-0">
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-8.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Wildan Ahdian"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-9.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="John Deo"></li>
                                                <li class="team-member team-member-sm"><img class="rounded-circle"
                                                                                            src="{{ asset('panel/assets/img/users/user-10.png') }}" alt="user" data-toggle="tooltip" title=""
                                                                                            data-original-title="Sarah Smith"></li>
                                                <li class="avatar avatar-sm"><span class="badge badge-primary">+4</span></li>
                                            </ul>
                                        </td>
                                        <td class="align-middle">
                                            <div class="progress-text">30%</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-orange" data-width="30%"></div>
                                            </div>
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>2019-05-28</td>
                                        <td>
                                            <div class="badge badge-info">Average</div>
                                        </td>
                                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <!-- Support tickets -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Support Ticket</h4>
                            <form class="card-header-form">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="support-ticket media pb-1 mb-3">
                                <img src="{{ asset('panel/assets/img/users/user-1.png') }}" class="user-img mr-2" alt="">
                                <div class="media-body ml-3">
                                    <div class="badge badge-pill badge-success mb-1 float-right">Feature</div>
                                    <span class="font-weight-bold">#89754</span>
                                    <a href="javascript:void(0)">Please add advance table</a>
                                    <p class="my-1">Hi, can you please add new table for advan...</p>
                                    <small class="text-muted">Created by <span class="font-weight-bold font-13">John
                          Deo</span>
                                        &nbsp;&nbsp; - 1 day ago</small>
                                </div>
                            </div>
                            <div class="support-ticket media pb-1 mb-3">
                                <img src="{{ asset('panel/assets/img/users/user-2.png') }}" class="user-img mr-2" alt="">
                                <div class="media-body ml-3">
                                    <div class="badge badge-pill badge-warning mb-1 float-right">Bug</div>
                                    <span class="font-weight-bold">#57854</span>
                                    <a href="javascript:void(0)">Select item not working</a>
                                    <p class="my-1">please check select item in advance form not work...</p>
                                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Sarah
                          Smith</span>
                                        &nbsp;&nbsp; - 2 day ago</small>
                                </div>
                            </div>
                            <div class="support-ticket media pb-1 mb-3">
                                <img src="{{ asset('panel/assets/img/users/user-3.png') }}" class="user-img mr-2" alt="">
                                <div class="media-body ml-3">
                                    <div class="badge badge-pill badge-primary mb-1 float-right">Query</div>
                                    <span class="font-weight-bold">#85784</span>
                                    <a href="javascript:void(0)">Are you provide template in Angular?</a>
                                    <p class="my-1">can you provide template in latest angular 8.</p>
                                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Ashton Cox</span>
                                        &nbsp;&nbsp; -2 day ago</small>
                                </div>
                            </div>
                            <div class="support-ticket media pb-1 mb-3">
                                <img src="{{ asset('panel/assets/img/users/user-6.png') }}" class="user-img mr-2" alt="">
                                <div class="media-body ml-3">
                                    <div class="badge badge-pill badge-info mb-1 float-right">Enhancement</div>
                                    <span class="font-weight-bold">#25874</span>
                                    <a href="javascript:void(0)">About template page load speed</a>
                                    <p class="my-1">Hi, John, can you work on increase page speed of template...</p>
                                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Hasan
                          Basri</span>
                                        &nbsp;&nbsp; -3 day ago</small>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="card-footer card-link text-center small ">View
                            All</a>
                    </div>
                    <!-- Support tickets -->
                </div>
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Projects Payments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Date</th>
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe </td>
                                        <td>11-08-2018</td>
                                        <td>NEFT</td>
                                        <td>$258</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Cara Stevens
                                        </td>
                                        <td>15-07-2018</td>
                                        <td>PayPal</td>
                                        <td>$125</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            Airi Satou
                                        </td>
                                        <td>25-08-2018</td>
                                        <td>RTGS</td>
                                        <td>$287</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            Angelica Ramos
                                        </td>
                                        <td>01-05-2018</td>
                                        <td>CASH</td>
                                        <td>$170</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            Ashton Cox
                                        </td>
                                        <td>18-04-2018</td>
                                        <td>NEFT</td>
                                        <td>$970</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>
                                            John Deo
                                        </td>
                                        <td>22-11-2018</td>
                                        <td>PayPal</td>
                                        <td>$854</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>
                                            Hasan Basri
                                        </td>
                                        <td>07-09-2018</td>
                                        <td>Cash</td>
                                        <td>$128</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="settingSidebar">
            <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
            </a>
            <div class="settingSidebar-body ps-container ps-theme-default">
                <div class=" fade show active">
                    <div class="setting-panel-header">Setting Panel
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Select Layout</h6>
                        <div class="selectgroup layout-color w-50">
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                                <span class="selectgroup-button">Light</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                                <span class="selectgroup-button">Dark</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Sidebar Color</h6>
                        <div class="selectgroup selectgroup-pills sidebar-color">
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <h6 class="font-medium m-b-10">Color Theme</h6>
                        <div class="theme-setting-options">
                            <ul class="choose-theme list-unstyled mb-0">
                                <li title="white" class="active">
                                    <div class="white"></div>
                                </li>
                                <li title="cyan">
                                    <div class="cyan"></div>
                                </li>
                                <li title="black">
                                    <div class="black"></div>
                                </li>
                                <li title="purple">
                                    <div class="purple"></div>
                                </li>
                                <li title="orange">
                                    <div class="orange"></div>
                                </li>
                                <li title="green">
                                    <div class="green"></div>
                                </li>
                                <li title="red">
                                    <div class="red"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                       id="mini_sidebar_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Mini Sidebar</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-15 border-bottom">
                        <div class="theme-setting-options">
                            <label class="m-b-0">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                       id="sticky_header_setting">
                                <span class="custom-switch-indicator"></span>
                                <span class="control-label p-l-10">Sticky Header</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                        <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                            <i class="fas fa-undo"></i> Restore Default
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
















    {{--<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                                <div class="text-base text-gray-600 mt-1">Item Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                                <div class="text-base text-gray-600 mt-1">New Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                                <div class="text-base text-gray-600 mt-1">Total Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                                <div class="text-base text-gray-600 mt-1">Unique Visitor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Sales Report
                    </h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                        <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-theme-19 dark:text-gray-300 text-lg xl:text-xl font-medium">$15,000</div>
                                <div class="mt-0.5 text-gray-600 dark:text-gray-600">This Month</div>
                            </div>
                            <div class="w-px h-12 border border-r border-dashed border-gray-300 dark:border-dark-5 mx-4 xl:mx-5"></div>
                            <div>
                                <div class="text-gray-600 dark:text-gray-600 text-lg xl:text-xl font-medium">$10,000</div>
                                <div class="mt-0.5 text-gray-600 dark:text-gray-600">Last Month</div>
                            </div>
                        </div>
                        <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                            <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false"> Filter by Category <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> </button>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2 overflow-y-auto h-32"> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">PC & Laptop</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Smartphone</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Electronic</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Photography</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Sport</a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="report-chart">
                        <canvas id="report-line-chart" height="169" class="mt-6"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Weekly Top Seller
                    </h2>
                    <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Show More</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="report-pie-chart" height="300"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                            <span class="truncate">17 - 30 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">62%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                            <span class="truncate">31 - 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">33%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                            <span class="truncate">>= 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">10%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Sales Report
                    </h2>
                    <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Show More</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="report-donut-chart" height="300"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                            <span class="truncate">17 - 30 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">62%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                            <span class="truncate">31 - 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">33%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                            <span class="truncate">>= 50 Years old</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">10%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Official Store -->
            <div class="col-span-12 xl:col-span-8 mt-6">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Official Store
                    </h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                        <i data-feather="map-pin" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" class="form-control sm:w-40 box pl-10" placeholder="Filter by city">
                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div>250 Official stores in 21 countries, click the marker to see location details.</div>
                    <div class="report-maps mt-5 bg-gray-200 rounded-md" data-center="-6.2425342, 106.8626478" data-sources="/dist/json/location.json"></div>
                </div>
            </div>
            <!-- END: Official Store -->
            <!-- BEGIN: Weekly Best Sellers -->
            <div class="col-span-12 xl:col-span-4 mt-6">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Weekly Best Sellers
                    </h2>
                </div>
                <div class="mt-5">
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-7.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Morgan Freeman</div>
                                <div class="text-gray-600 text-xs mt-0.5">11 June 2022</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">137 Sales</div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-5.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Johnny Depp</div>
                                <div class="text-gray-600 text-xs mt-0.5">27 March 2021</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">137 Sales</div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-13.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Johnny Depp</div>
                                <div class="text-gray-600 text-xs mt-0.5">28 August 2020</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">137 Sales</div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-8.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Johnny Depp</div>
                                <div class="text-gray-600 text-xs mt-0.5">22 December 2022</div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">137 Sales</div>
                        </div>
                    </div>
                    <a href="" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
                </div>
            </div>
            <!-- END: Weekly Best Sellers -->
            <!-- BEGIN: General Report -->
            <div class="col-span-12 grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">Target Sales</div>
                                <div class="text-gray-600 mt-1">300 Sales</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                <canvas id="report-donut-chart-1" width="90" height="90"></canvas>
                                <div class="font-medium absolute w-full h-full flex items-center justify-center top-0 left-0">20%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="box p-5 zoom-in">
                        <div class="flex">
                            <div class="text-lg font-medium truncate mr-3">Social Media</div>
                            <div class="py-1 px-2 flex items-center rounded-full text-xs bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300 cursor-pointer ml-auto truncate">320 Followers</div>
                        </div>
                        <div class="mt-4">
                            <canvas class="simple-line-chart-1 -ml-1" height="60"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="box p-5 zoom-in">
                        <div class="flex items-center">
                            <div class="w-2/4 flex-none">
                                <div class="text-lg font-medium truncate">New Products</div>
                                <div class="text-gray-600 mt-1">1450 Products</div>
                            </div>
                            <div class="flex-none ml-auto relative">
                                <canvas id="report-donut-chart-2" width="90" height="90"></canvas>
                                <div class="font-medium absolute w-full h-full flex items-center justify-center top-0 left-0">45%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                    <div class="box p-5 zoom-in">
                        <div class="flex">
                            <div class="text-lg font-medium truncate mr-3">Posted Ads</div>
                            <div class="py-1 px-2 flex items-center rounded-full text-xs bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300 cursor-pointer ml-auto truncate">180 Campaign</div>
                        </div>
                        <div class="mt-4">
                            <canvas class="simple-line-chart-1 -ml-1" height="60"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Weekly Top Products -->
            <div class="col-span-12 mt-6">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Weekly Top Products
                    </h2>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <button class="btn box flex items-center text-gray-700 dark:text-gray-300"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel </button>
                        <button class="ml-3 btn box flex items-center text-gray-700 dark:text-gray-300"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF </button>
                    </div>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap">IMAGES</th>
                            <th class="whitespace-nowrap">PRODUCT NAME</th>
                            <th class="text-center whitespace-nowrap">STOCK</th>
                            <th class="text-center whitespace-nowrap">STATUS</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-3.jpg" title="Uploaded at 11 June 2022">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-8.jpg" title="Uploaded at 11 December 2020">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-11.jpg" title="Uploaded at 14 September 2021">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">Nike Air Max 270</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Sport &amp; Outdoor</div>
                            </td>
                            <td class="text-center">50</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-theme-6"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Inactive </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href=""> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-13.jpg" title="Uploaded at 27 March 2021">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-3.jpg" title="Uploaded at 3 June 2020">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-2.jpg" title="Uploaded at 11 March 2021">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                            </td>
                            <td class="text-center">50</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Active </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href=""> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-4.jpg" title="Uploaded at 28 August 2020">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-3.jpg" title="Uploaded at 27 September 2021">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-7.jpg" title="Uploaded at 19 April 2022">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">Sony Master Series A9G</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">Electronic</div>
                            </td>
                            <td class="text-center">127</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-theme-6"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Inactive </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href=""> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-6.jpg" title="Uploaded at 22 December 2022">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-12.jpg" title="Uploaded at 19 December 2022">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-15.jpg" title="Uploaded at 19 August 2022">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">Dell XPS 13</a>
                                <div class="text-gray-600 text-xs whitespace-nowrap mt-0.5">PC &amp; Laptop</div>
                            </td>
                            <td class="text-center">59</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center text-theme-6"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Inactive </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href=""> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-theme-6" href=""> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
                    <ul class="pagination">
                        <li>
                            <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                        </li>
                        <li>
                            <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a>
                        </li>
                        <li> <a class="pagination__link" href="">...</a> </li>
                        <li> <a class="pagination__link" href="">1</a> </li>
                        <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
                        <li> <a class="pagination__link" href="">3</a> </li>
                        <li> <a class="pagination__link" href="">...</a> </li>
                        <li>
                            <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a>
                        </li>
                        <li>
                            <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                        </li>
                    </ul>
                    <select class="w-20 form-select box mt-3 sm:mt-0">
                        <option>10</option>
                        <option>25</option>
                        <option>35</option>
                        <option>50</option>
                    </select>
                </div>
            </div>
            <!-- END: Weekly Top Products -->
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-3">
        <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- BEGIN: Transactions -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Transactions
                        </h2>
                    </div>
                    <div class="mt-5">
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-7.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Morgan Freeman</div>
                                    <div class="text-gray-600 text-xs mt-0.5">11 June 2022</div>
                                </div>
                                <div class="text-theme-6">-$65</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-5.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Johnny Depp</div>
                                    <div class="text-gray-600 text-xs mt-0.5">27 March 2021</div>
                                </div>
                                <div class="text-theme-9">+$119</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-13.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Johnny Depp</div>
                                    <div class="text-gray-600 text-xs mt-0.5">28 August 2020</div>
                                </div>
                                <div class="text-theme-6">-$127</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-8.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Johnny Depp</div>
                                    <div class="text-gray-600 text-xs mt-0.5">22 December 2022</div>
                                </div>
                                <div class="text-theme-6">-$115</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-6.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Russell Crowe</div>
                                    <div class="text-gray-600 text-xs mt-0.5">15 December 2020</div>
                                </div>
                                <div class="text-theme-6">-$50</div>
                            </div>
                        </div>
                        <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
                    </div>
                </div>
                <!-- END: Transactions -->
                <!-- BEGIN: Recent Activities -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Recent Activities
                        </h2>
                        <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Show More</a>
                    </div>
                    <div class="report-timeline mt-5 relative">
                        <div class="intro-x relative flex items-center mb-3">
                            <div class="report-timeline__image">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-8.jpg">
                                </div>
                            </div>
                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                <div class="flex items-center">
                                    <div class="font-medium">Edward Norton</div>
                                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                                </div>
                                <div class="text-gray-600 mt-1">Has joined the team</div>
                            </div>
                        </div>
                        <div class="intro-x relative flex items-center mb-3">
                            <div class="report-timeline__image">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-2.jpg">
                                </div>
                            </div>
                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                <div class="flex items-center">
                                    <div class="font-medium">Brad Pitt</div>
                                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                                </div>
                                <div class="text-gray-600">
                                    <div class="mt-1">Added 3 new photos</div>
                                    <div class="flex mt-2">
                                        <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Nike Air Max 270">
                                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-md border border-white" src="dist/images/preview-12.jpg">
                                        </div>
                                        <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Samsung Q90 QLED TV">
                                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-md border border-white" src="dist/images/preview-10.jpg">
                                        </div>
                                        <div class="tooltip w-8 h-8 image-fit mr-1 zoom-in" title="Sony Master Series A9G">
                                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-md border border-white" src="dist/images/preview-5.jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="intro-x text-gray-500 text-xs text-center my-4">12 November</div>
                        <div class="intro-x relative flex items-center mb-3">
                            <div class="report-timeline__image">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-2.jpg">
                                </div>
                            </div>
                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                <div class="flex items-center">
                                    <div class="font-medium">Keira Knightley</div>
                                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                                </div>
                                <div class="text-gray-600 mt-1">Has changed <a class="text-theme-1 dark:text-theme-10" href="">Samsung Galaxy S20 Ultra</a> price and description</div>
                            </div>
                        </div>
                        <div class="intro-x relative flex items-center mb-3">
                            <div class="report-timeline__image">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-1.jpg">
                                </div>
                            </div>
                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                <div class="flex items-center">
                                    <div class="font-medium">Denzel Washington</div>
                                    <div class="text-xs text-gray-500 ml-auto">07:00 PM</div>
                                </div>
                                <div class="text-gray-600 mt-1">Has changed <a class="text-theme-1 dark:text-theme-10" href="">Samsung Q90 QLED TV</a> description</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Recent Activities -->
                <!-- BEGIN: Important Notes -->
                <div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-auto">
                            Important Notes
                        </h2>
                        <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"> <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                        <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"> <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                    </div>
                    <div class="mt-5 intro-x">
                        <div class="box zoom-in">
                            <div class="tiny-slider" id="important-notes">
                                <div class="p-5">
                                    <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                                    <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                    <div class="font-medium flex mt-5">
                                        <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                        <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto">Dismiss</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Important Notes -->
                <!-- BEGIN: Schedules -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Schedules
                        </h2>
                        <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate flex items-center"> <i data-feather="plus" class="w-4 h-4 mr-1"></i> Add New Schedules </a>
                    </div>
                    <div class="mt-5">
                        <div class="intro-x box">
                            <div class="p-5">
                                <div class="flex">
                                    <i data-feather="chevron-left" class="w-5 h-5 text-gray-600"></i>
                                    <div class="font-medium text-base mt-5 mx-auto">April</div>
                                    <i data-feather="chevron-right" class="w-5 h-5 text-gray-600"></i>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mt-5 text-center">
                                    <div class="font-medium">Su</div>
                                    <div class="font-medium">Mo</div>
                                    <div class="font-medium">Tu</div>
                                    <div class="font-medium">We</div>
                                    <div class="font-medium">Th</div>
                                    <div class="font-medium">Fr</div>
                                    <div class="font-medium">Sa</div>
                                    <div class="py-0.5 rounded relative text-gray-600">29</div>
                                    <div class="py-0.5 rounded relative text-gray-600">30</div>
                                    <div class="py-0.5 rounded relative text-gray-600">31</div>
                                    <div class="py-0.5 rounded relative">1</div>
                                    <div class="py-0.5 rounded relative">2</div>
                                    <div class="py-0.5 rounded relative">3</div>
                                    <div class="py-0.5 rounded relative">4</div>
                                    <div class="py-0.5 rounded relative">5</div>
                                    <div class="py-0.5 bg-theme-18 dark:bg-theme-9 rounded relative">6</div>
                                    <div class="py-0.5 rounded relative">7</div>
                                    <div class="py-0.5 bg-theme-1 dark:bg-theme-1 text-white rounded relative">8</div>
                                    <div class="py-0.5 rounded relative">9</div>
                                    <div class="py-0.5 rounded relative">10</div>
                                    <div class="py-0.5 rounded relative">11</div>
                                    <div class="py-0.5 rounded relative">12</div>
                                    <div class="py-0.5 rounded relative">13</div>
                                    <div class="py-0.5 rounded relative">14</div>
                                    <div class="py-0.5 rounded relative">15</div>
                                    <div class="py-0.5 rounded relative">16</div>
                                    <div class="py-0.5 rounded relative">17</div>
                                    <div class="py-0.5 rounded relative">18</div>
                                    <div class="py-0.5 rounded relative">19</div>
                                    <div class="py-0.5 rounded relative">20</div>
                                    <div class="py-0.5 rounded relative">21</div>
                                    <div class="py-0.5 rounded relative">22</div>
                                    <div class="py-0.5 bg-theme-17 dark:bg-theme-11 rounded relative">23</div>
                                    <div class="py-0.5 rounded relative">24</div>
                                    <div class="py-0.5 rounded relative">25</div>
                                    <div class="py-0.5 rounded relative">26</div>
                                    <div class="py-0.5 bg-theme-14 dark:bg-theme-12 rounded relative">27</div>
                                    <div class="py-0.5 rounded relative">28</div>
                                    <div class="py-0.5 rounded relative">29</div>
                                    <div class="py-0.5 rounded relative">30</div>
                                    <div class="py-0.5 rounded relative text-gray-600">1</div>
                                    <div class="py-0.5 rounded relative text-gray-600">2</div>
                                    <div class="py-0.5 rounded relative text-gray-600">3</div>
                                    <div class="py-0.5 rounded relative text-gray-600">4</div>
                                    <div class="py-0.5 rounded relative text-gray-600">5</div>
                                    <div class="py-0.5 rounded relative text-gray-600">6</div>
                                    <div class="py-0.5 rounded relative text-gray-600">7</div>
                                    <div class="py-0.5 rounded relative text-gray-600">8</div>
                                    <div class="py-0.5 rounded relative text-gray-600">9</div>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 dark:border-dark-5 p-5">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                    <span class="truncate">UI/UX Workshop</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">23th</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-1 dark:bg-theme-10 rounded-full mr-3"></div>
                                    <span class="truncate">VueJs Frontend Development</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">10th</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                    <span class="truncate">Laravel Rest API</span>
                                    <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                    <span class="font-medium xl:ml-auto">31th</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Schedules -->
            </div>
        </div>
    </div>
    </div>--}}
@endsection
