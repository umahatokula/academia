<div class="sidebar-menu toggle-others fixed">
    
      <div class="sidebar-menu-inner">
        
        <header class="logo-env">
    
          <!-- logo -->
          <div class="logo">
            <a href="{!! url('/') !!}" class="logo-expanded">
              <img src="assets/images/logo@2x.png" width="80" alt="" />
            </a>
    
            <a href="{!! url('/') !!}" class="logo-collapsed">
              <img src="assets/images/logo-collapsed@2x.png" width="40" alt="" />
            </a>
          </div>
    
          <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
          <div class="mobile-menu-toggle visible-xs">
            <a href="#" data-toggle="user-info-menu">
              <i class="fa-bell-o"></i>
              <span class="badge badge-success">7</span>
            </a>
    
            <a href="#" data-toggle="mobile-menu">
              <i class="fa-bars"></i>
            </a>
          </div>
    
          <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
          <div class="settings-icon">
            <a href="#" data-toggle="settings-pane" data-animate="true">
              <i class="linecons-cog"></i>
            </a>
          </div>
        </header>

        <!-- Sidebar User Info Bar - Added in 1.3 -->
        <section class="sidebar-user-info" >
          <div class="sidebar-user-info-inner">
            <a href="" class="user-profile">
              <img src="{!! asset('assets/images/user-4.png') !!}" width="60" height="60" class="img-circle img-corona" alt="user-pic" />
        
              <span>
                <strong>{!! Sentinel::getUser()->first_name !!}</strong>
                Page admin
              </span>
            </a>
        
            <ul class="user-links list-unstyled">
              <li>
                <a href="" title="Edit profile">
                  <i class="linecons-user"></i>
                  View profile
                </a>
              </li>
              <li>
                <a href="mailbox-main.html" title="Mailbox">
                  <i class="linecons-mail"></i>
                  Mailbox
                </a>
              </li>
              <li class="logout-link">
                <a href="{!! route('logout') !!}" title="Log out">
                  <i class="fa-power-off"></i>
                </a>
              </li>
            </ul>
          </div>
        </section>


            <ul id="main-menu" class="main-menu">
          <!-- add class "multiple-expanded" to allow multiple submenus to open -->
          <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
          <li class="opened active">
            <a href="{!! url('/') !!}">
              <i class="linecons-cog"></i>
              <span class="title">Dashboard</span>
            </a>
          </li>
          <li class="opened active">
            <a href="{!! route('academics.results.index') !!}">
              <i class="linecons-cog"></i>
              <span class="title">Results</span>
            </a>
          </li>
          <li class="opened active">
            <a href="#">
              <i class="linecons-cog"></i>
              <span class="title">Admin</span>
            </a>
            <ul>
              <li>
                <a href="{!! route('admin.students.index') !!}">
                  <span class="title">Students</span>
                </a>
              </li>
              <li>
                <a href="{!! route('admin.parents.index') !!}">
                  <span class="title">Parents</span>
                </a>
              </li>
              <li>
                <a href="{!! route('admin.staff.index') !!}">
                  <span class="title">Staff</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="linecons-desktop"></i>
              <span class="title">Settings</span>
            </a>
            <ul>
              <li>
                <a href="{!! url('settings/classes/') !!}">
                  <span class="title">Classes</span>
                </a>
              </li>
              <li>
                <a href="{!! url('settings/subjects/') !!}">
                  <span class="title">Subjects</span>
                </a>
              </li>
              <li>
                <a href="{!! url('settings/users/create') !!}">
                  <span class="title">Users</span>
                </a>
              </li>
              <li>
                <a href="{!! url('settings/roles') !!}">
                  <span class="title">Roles &amp; Permissions</span>
                </a>
              </li>
            </ul>
              </li>
            </ul>
          </li>
        </ul>
        
      </div>
    
    </div>