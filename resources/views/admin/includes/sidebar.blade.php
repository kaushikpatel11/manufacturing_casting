<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <?php 
                        $img = asset('/images/default-user.jpg');
                        if(Auth::guest()){
                        }else{
                            if(!empty(\Auth::user()->image))
                                $img = asset('/uploads/users/'.Auth::user()->image);
                        }
                    ?>
                    <img src="{{ $img }}" alt="image"/>
                    <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                    <p class="name">
                        @if(Auth::guest())
                        @else
                            {{ \Auth::user()->name }}
                        @endif
                    </p>
                    <p class="designation">
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_dashboard') }}">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('banners.index') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">Banner</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contents.index') }}">
                <i class="icon-list menu-icon"></i>
                <span class="menu-title">Content</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="true" aria-controls="tables">
                <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Setting</span>
            </a>
            <div class="collapse" id="tables" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('settings') }}">Basic Setting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin_edit_profile') }}">My Profile</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin_change_password') }}">Change Password</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>

<!-- partial -->
