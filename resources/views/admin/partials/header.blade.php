<div class="header navbar navbar-fixed-top">
    <div class="header-inner">
        <a class="navbar-brand" href="#">Admin</a>
        <a href="#" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="{{ asset('/admin/images/admin/menu-toggler.png') }}" alt=""/>
        </a>
        <ul class="nav navbar-nav pull-right">
            @if(Auth::user())
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                    <span class="username">
					</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            {{--!! link_to_route('admin.users.edit', Auth::user()->email, ['id' => Auth::user()->id]) !!--}}
                        </li>
                        <li>
                            <a href="{{ url('admin/auth/logout') }}">
                                <i class="fa fa-key"></i> Изход
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
