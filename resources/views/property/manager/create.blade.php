@extends('admin.layout.app')
@section('title', 'Create New User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <form method="post" action="{{ route('property_admin.manager.store') }}">
                @csrf

                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
