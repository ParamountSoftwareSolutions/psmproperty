@extends('property_manager.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        @livewire('building-manager-detail-form')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
