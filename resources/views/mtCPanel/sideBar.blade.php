<nav id="sideNav"><!-- MAIN MENU -->
    <ul class="nav nav-list">
        <li>
            <a  class="dashboard1" href="{{ request()->root() }}">
                <i class="main-icon fa fa-home" aria-hidden="true"></i>
                <span> @lang('site.home') </span>
            </a>
        </li>
        <li>
            <a href="{{ request()->root() }}/mtCPanel">
                <i class="main-icon fa fa-desktop" aria-hidden="true"></i>
                <span> حسابي </span>
            </a>
        </li>
        @foreach(Config::get("mtcpanel.dashboardMenuArr") as $DBM)
            <li class="active1">
                <a href="#">
                    <i class="fa fa-menu-arrow pull-left"></i>
                    <i class="main-icon fa fa-spin fa-cog"></i>
                    <span>{{$DBM['sectionTitle']}}</span>
                </a>
                <ul>
                    @foreach($DBM['menuData'] as $DBMItem)
                        @if(auth()->guard('admin')->user()->hasMainPriv($DBMItem['menuID']))
                            <li class="@if(request()->segment(2) == $DBMItem['menuID']) active @endif">
                                <a href="{{ request()->root() }}/mtCPanel/{{$DBMItem['menuID']}}">
                                    <i class="fa fa-{{$DBMItem['menuIcon']}}" aria-hidden="true"></i>
                                    {{Lang::get('admin.'.$DBMItem['menuID'])}}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</nav>
