@extends('property.layout.app')
@section('title', 'Fcm notification')
@section('style')
    <style>
        .custom-switches-stacked > .custom-switch {
            font-size: 16px;
            padding-left: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('property_admin.setting.update_server_key') }}" autocomplete="off">
                                @csrf
                                <div class="card-header">
                                    <h4>Fire Base Notification Server Key</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @php($key=\App\Models\User::where('id', \Illuminate\Support\Facades\Auth::id())->first()->server_key)

                                        <div class="form-group col-md-12">
                                            <textarea name="server_key" class="form-control">{{$key}}</textarea>
                                            @error('server_key')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <form method="post" action="{{ route('property_admin.setting.update_push_notification') }}" autocomplete="off">
                                @csrf
                                <div class="card-header">
                                    <h4>Fire Base Notification Setting</h4>
                                </div>
                                <div class="card-body">
                                    {{--<div class="section-title mt-0">Sale Man Notification</div>--}}
                                    <div class="row">
                                        @php($la=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_add'])->first()->value)
                                        @php($data=json_decode($la,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_add_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Add Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_add_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_add_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($lu=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_update'])->first()->value)
                                        @php($data=json_decode($lu,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_update_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Update Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_update_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_update_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($lfu=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_follow_up'])->first()->value)
                                        @php($data=json_decode($lfu,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_follow_up_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Follow Up Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_follow_up_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_follow_up_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($ld=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_discussion'])->first()->value)
                                        @php($data=json_decode($ld,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_discussion_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Discussion Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_discussion_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_discussion_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($ln=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_negotiation'])->first()->value)
                                        @php($data=json_decode($ln,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_negotiation_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Negotiation Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_negotiation_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_negotiation_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($ll=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_lost'])->first()->value)
                                        @php($data=json_decode($ll,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_lost_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Lost Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_lost_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_lost_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($lm=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_mature'])->first()->value)
                                        @php($data=json_decode($lm,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_mature_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Lead Mature Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_mature_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_mature_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($sact=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_active'])->first()->value)
                                        @php($data=json_decode($sact,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_active_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Active Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_active_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_active_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($sa=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_add'])->first()->value)
                                        @php($data=json_decode($sa,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_add_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Add Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_add_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_add_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($su=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_update'])->first()->value)
                                        @php($data=json_decode($su,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_update_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Update Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_update_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_update_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($sc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_cancel'])->first()->value)
                                        @php($data=json_decode($sc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_cancel_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Cancel Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_cancel_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_cancel_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($sl=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_suspended'])->first()->value)
                                        @php($data=json_decode($sl,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_suspended_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Lost Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_suspended_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_suspended_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($ec=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'employee_create'])->first()->value)
                                        @php($data=json_decode($ec,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="employee_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Employee Create Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="employee_create_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('employee_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($pc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'property_create'])->first()->value)
                                        @php($data=json_decode($pc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="property_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Property Add Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="property_create_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('property_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($pc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'possession_create'])->first()->value)
                                        @php($data=json_decode($pc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="possession_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Possession Create Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="possession_create_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('possession_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($pa=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'possession_accept'])->first()->value)
                                        @php($data=json_decode($pa,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="possession_accept_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Possession Accept Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="possession_accept_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('possession_accept_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($pr=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'possession_rejected'])->first()->value)
                                        @php($data=json_decode($pr,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="possession_rejected_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Possession Rejected Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="possession_rejected_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('possession_rejected_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($pp=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'possession_pending'])->first()->value)
                                        @php($data=json_decode($pp,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="possession_pending_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Possession Pending Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="possession_pending_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('possession_pending_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($tc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'transfer_create'])->first()->value)
                                        @php($data=json_decode($tc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="transfer_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Transfer Create Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="transfer_create_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('transfer_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($ta=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'transfer_accept'])->first()->value)
                                        @php($data=json_decode($ta,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="transfer_accept_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Transfer Accept Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="transfer_accept_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('transfer_accept_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($tr=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'transfer_rejected'])->first()->value)@dd($tr)
                                        @php($data=json_decode($tr,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="transfer_rejected_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Transfer Rejected Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="transfer_rejected_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('transfer_rejected_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($tp=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'transfer_pending'])->first()->value)
                                        @php($data=json_decode($tp,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="transfer_pending_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Transfer Pending Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="transfer_pending_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('transfer_pending_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($fc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'file_create'])->first()->value)
                                        @php($data=json_decode($fc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="file_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">File Create Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="file_create_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('file_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($fa=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'file_accept'])->first()->value)
                                        @php($data=json_decode($fa,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="file_accept_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">File Accept Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="file_accept_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('file_accept_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($fr=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'file_rejected'])->first()->value)
                                        @php($data=json_decode($fr,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="file_rejected_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">File Rejected Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="file_rejected_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('file_rejected_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($fp=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' => \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'file_pending'])->first()->value)
                                        @php($data=json_decode($fp,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="file_pending_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">File Pending Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="file_pending_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('file_pending_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($rc=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'reserve_create'])->first()->value)
                                        @php($data=json_decode($rc,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="reserve_create_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Reserve Create Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="reserve_create_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('reserve_create_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($ra=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'reserve_accept'])->first()->value)
                                        @php($data=json_decode($ra,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="reserve_accept_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Reserve Accept Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="reserve_accept_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('reserve_accept_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php($rr=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'reserve_rejected'])->first()->value)
                                        @php($data=json_decode($rr,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="reserve_rejected_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Reserve Rejected Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="reserve_rejected_message" class="form-control">{{$data['message']}}{{$data['message']}}</textarea>
                                                @error('reserve_rejected_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        @php($rp=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'reserve_pending'])->first()->value)
                                        @php($data=json_decode($rp,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="reserve_pending_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Reserve Pending Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="reserve_pending_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('reserve_pending_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php($st=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'sale_transfer'])->first()->value)
                                        @php($data=json_decode($st,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="sale_transfer_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Cancel Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="sale_transfer_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('sale_transfer_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php($las=\App\Models\BuildingSetting::where(['user_id' => \Illuminate\Support\Facades\Auth::id(), 'user_type' =>
                                        \Illuminate\Support\Facades\Auth::user()->roles[0]->name, 'key' => 'lead_assign'])->first()->value)
                                        @php($data=json_decode($las,true))
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <div class="custom-switches-stacked mt-2">
                                                    <label class="custom-switch pl-0">
                                                        <input type="checkbox" name="lead_assign_status" {{$data['status']==1?'checked':''}} class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Sale Cancel Message</span>
                                                    </label>
                                                </div>
                                                <textarea name="lead_assign_message" class="form-control">{{$data['message']}}</textarea>
                                                @error('lead_assign_message')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')

@endsection
