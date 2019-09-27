
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
       
        <div class="pull-left image">
          <?php $url = \URL::To('public/icon').'/user.png';
          if(@Auth::guard('admin')->user()->image){
            $url = \URL::To('storage/images/adminimage/').'/'.Auth::guard('admin')->user()->image;
          } ?>
          <img src="{{ $url }}" class="img-circle" alt="User Image">
        </div>

        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
  <!--     <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
       <!--  <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> -->
        <li class="@if(@$active && $active=='home')active @endif">
          <a href="{{ url('admin/home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
         
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('admin/quiz') }}"><i class="fa fa-circle-o"></i> Quiz</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stock Picks</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Videos & Articles</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Insights & Editors notes</a></li>
          </ul>
        </li>
        <li class="">
          <a href="#">
            <i class="fa fa-angle-double-right"></i> <span>Package</span>
          </a>
        </li>
        <li class="@if(@$active && $active=='Users')active @endif">
          <a href="{{ url('admin/users') }}">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <li class="@if(@$active && $active=='About')active @endif">
          <a href="{{ url('admin/aboutus') }}">
            <i class="fa fa-info-circle"></i> <span>About Us</span>
          </a>
        </li>
        <li class="@if(@$active && $active=='Policy')active @endif">
          <a href="{{ url('admin/policy') }}">
            <i class="fa fa-lock"></i> <span>Privacy Policy</span>
          </a>
        </li>
        <li class="@if(@$active && $active=='Terms_Condition')active @endif">
          <a href="{{ url('admin/temscondition') }}">
            <i class="fa fa-legal"></i> <span>Terms & Conditions</span>
          </a>
        </li>
       
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li> -->
        <!-- <li class="header">LABELS</li> -->
        <li class="@if(@$active && $active=='Profile')active @endif">
          <a href="{{ url('admin/profile') }}">
            <i class="fa fa-user"></i> <span>My Profile</span>
          </a>
        </li>
        <li class="@if(@$active && $active=='ChangePassword')active @endif">
          <a href="{{ url('admin/changepassword') }}">
            <i class="fa fa-key"></i> <span>Change Password</span>
          </a>
        </li>
        <li>
          <a  href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> 
          <span>Sign out</span>
          </a>
          <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>