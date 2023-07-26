<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile px-10 py-15">
            <div class="d-flex align-items-center">
                <div class="image">
                    <img src="{{ url('img/avatar-13.png') }}" class="avatar avatar-lg bg-primary-light" alt="User Image">
                </div>
                <div class="info ml-10">
                    <p class="mb-0">{{ __('Welcome Back!') }}</p>
                    @if(Auth::check())
                    <h5 class="mb-0">{{ Auth::user()->fullname }}</h5>
                    @endif
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ route('dashboard.index') }}">
                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>

           
            <li class="treeview {{ (request()->is('panel/products/*') || request()->is('panel/options/*')) ? 'active':''  }}">
                <a href="javascript:void(0)">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <span>{{ __('Products') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu ">
                    <li class="{{ (request()->is('panel/products')) ? 'active':''  }}">
                        <a href="{{ route('products.panel') }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i>{{ __('Products') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/categories')) ? 'active':''  }}">
                        <a href="{{ route('categories.panel') }}"><i class="fa fa-cubes" aria-hidden="true"></i> {{ __('Categories') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/manufacturers')) ? 'active':''  }}">
                        <a href="{{ route('manufacturers.panel') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> {{ __('Manufacturers') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/options')) ? 'active':''  }}">
                        <a href="{{ route('options.panel') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> {{ __('Options') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/taxclasses')) ? 'active':''  }}">
                        <a href="{{ route('taxclasses.panel') }}"><i class="fa fa-percent" aria-hidden="true"></i> {{ __('Tax') }} </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ (request()->is('panel/membership/*')) ? 'active':''  }}">
                <a href="javascript:void(0)">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>{{ __('Customers') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu ">
                    <li class="{{ (request()->is('panel/customerlist')) ? 'active':''  }}">
                        <a href="{{ route('customer.panel') }}"><i class="fa fa-users" aria-hidden="true"></i>{{ __('Customers') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/customergroups')) ? 'active':''  }}">
                        <a href="{{ route('customergroups.panel') }}"><i class="fa fa-object-group" aria-hidden="true"></i> {{ __('Customer groups') }} </a>
                    </li>
                    <li class="{{ (request()->is('panel/membership')) ? 'active':''  }}">
                        <a href="{{ route('membership.panel') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> {{ __('Membership Request') }} </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>{{ __('Marketing') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu ">
                    <li class="{{ (request()->is('panel/customerlist')) ? 'active':''  }}">
                        <a href="{{ route('customer.panel') }}"><i class="fa fa-users" aria-hidden="true"></i>{{ __('Coupon Code') }} </a>
                    </li>

                </ul>
            </li>
             <li class="header">{{ __('Developers') }} </li>


            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <span>{{ __('Authentication') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu ">
                    <li class="{{ (request()->is('panel/client')) ? 'active':''  }}">
                        <a href="{{ route('client.panel') }}"><i class="fa  fa-user-circle-o" aria-hidden="true"></i>{{ __('Users') }} </a>
                    </li>

                </ul>
            </li> 


        </ul>
    </section>
</aside>
