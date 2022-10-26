<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route(\App\Helpers\Helpers::user_login_route()['file'].'.dashboard')  }}">
                <img alt="image" src="{{ asset('public/panel/assets/img/logo.png') }}" class="header-logo" style="height:150px !important;margin-top: -20px !important;"/>
            </a>
        </div>
        <ul class="sidebar-menu">
            {{-- Property Admin --}}
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['property_admin','property_manager','sale_manager','sale_person']))
                @include('property_manager.includes.__sidebar.property_admin')

                {{-- Property Manager --}}
            @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('property_manager'))
                @include('property_manager.includes.__sidebar.property_admin')


                {{-- Sale Manager --}}
            @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('sale_manager'))

                {{-- Sale Person --}}
            @elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('sale_person'))




                {{-- Account--}}
            {{--@elseif(\Illuminate\Support\Facades\Auth::user()->hasRole('account'))
                --}}
            @endif

        </ul>
    </aside>
</div>
