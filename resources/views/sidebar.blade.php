<div class="sidebar-menu toggle-others fixed">
<?php //dd(\Session::get('user')->staff_id) ?>
<?php 
$user = \Sentinel::getUser();
$roles = session('roles');
?>
    
      <div class="sidebar-menu-inner">
        
        <header class="logo-env">
    
          <!-- logo -->
          <div class="logo">
            <a href="{!! url('/') !!}" class="logo-expanded">
              <img src="{!! asset('assets/images/logo/1.png') !!}" width="80" alt="" />
            </a>
    
            <a href="{!! url('/') !!}" class="logo-collapsed">
              <img src="{!! asset('assets/images/logo-collapsed@2x.png') !!}" width="80" alt="" />
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
          <!-- <div class="settings-icon">
            <a href="#" data-toggle="settings-pane" data-animate="true">
              <i class="linecons-cog"></i>
            </a>
          </div> -->
        </header>

        <!-- Sidebar User Info Bar - Added in 1.3 -->
        <section class="sidebar-user-info" >
          <div class="sidebar-user-info-inner">
            <a href="" class="user-profile">
              <img src="{!! asset('assets/images/staff/'.\Session::get('user')->staff_id.'.jpg') !!}" width="100" height="100" class="img-circle img-corona" alt="user-pic" />
        
              <span>
                <strong>{!! Sentinel::getUser()->first_name !!}</strong>
                @foreach($roles as $role)
                {!! $role->name  !!} <br>
                @endforeach
              </span>
            </a>
        
            <ul class="user-links list-unstyled">
              <li>
                <a href="{!! route('admin.staff.show', array(Sentinel::getUser()->staff_id )) !!}" title="View profile">
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
          <li class="{!! (isset($home))? 'opened active': ''; !!}">
            <a href="{!! url('/') !!}">
              <i class="linecons-cog"></i>
              <span class="title">Dashboard</span>
            </a>
          </li>
          <!-- visible to only head teacher, principal and me -->
          <?php if($user->inRole('coder') || $user->inRole('principal') || $user->inRole('head_teacher')){ ?>
          <li class="{!! (isset($results_menu))? 'opened active': ''; !!}">
            <a href="{!! route('academics.results.index') !!}">
              <i class="linecons-cog"></i>
              <span class="title">Results</span>
            </a>
          </li>
          <?php } ?>
          <!-- visible to only admin dept officer, principal and me -->
          <?php if($user->inRole('coder') || $user->inRole('principal') || $user->inRole('admin_dept_officer')){ ?>
          <li class="{!! (isset($students_menu) || isset($parents_menu) || isset($staff_menu))? 'opened active': ''; !!}">
            <a href="#">
              <i class="linecons-cog"></i>
              <span class="title">Admin</span>
            </a>
            <ul>
              <li class="{!! (isset($students_menu) && $students_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! route('admin.students.index') !!}">
                  <span class="title">Students</span>
                </a>
              </li>
              <li class="{!! (isset($parents_menu) && $parents_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! route('admin.parents.index') !!}">
                  <span class="title">Parents</span>
                </a>
              </li>
              <li class="{!! (isset($staff_menu) && $staff_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! route('admin.staff.index') !!}">
                  <span class="title">Staff</span>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- visible to only billing officer, principal and me -->
          <?php if($user->inRole('coder') || $user->inRole('principal') || $user->inRole('billing_officer')){ ?>
          <li class="{!! (isset($fee_schedules_menu) || isset($fee_elements_menu) || isset($invoice_menu) || isset($discount_policies_menu))? 'opened active': ''; !!}">
            <a href="#">
              <i class="linecons-desktop"></i>
              <span class="title">Billing</span>
            </a>
            <ul>
              <li class="{!! (isset($invoice_menu) && $invoice_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('billing/invoices') !!}">
                  <span class="title">Invoices</span>
                </a>
              </li>
              <li class="{!! (isset($fee_schedules_menu) && $fee_schedules_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('billing/fee_schedules') !!}">
                  <span class="title">Fee Schedules</span>
                </a>
              </li>
              <li class="{!! (isset($fee_elements_menu) && $fee_elements_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('billing/fee_elements') !!}">
                  <span class="title">Fee Elements</span>
                </a>
              </li>
              <li class="{!! (isset($discount_policies_menu) && $discount_policies_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('billing/discount_policies') !!}">
                  <span class="title">Discount Policies</span>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- visible to only accounts officer, principal and me -->
          <?php if($user->inRole('coder') || $user->inRole('principal') || $user->inRole('accounts_officer')){ ?>
          <li class="{!! (isset($accounts_menu))? 'opened active': ''; !!}">
            <a href="#">
              <i class="linecons-desktop"></i>
              <span class="title">Accounts</span>
            </a>
            <ul>
              <li class="{!! (isset($payments_menu) && $payments_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('payments') !!}">
                  <span class="title">Payments</span>
                </a>
              </li>
              <li class="{!! (isset($accounts_menu) && $accounts_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('accounts/reports') !!}">
                  <span class="title">Reports</span>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- visible to only principal and me -->
          <?php if($user->inRole('coder') || $user->inRole('principal')){ ?>
          <li class="{!! (isset($classes_menu) || isset($subjects_menu) || isset($school_menu) || isset($users_menu))? 'opened active': ''; !!}">
            <a href="#">
              <i class="linecons-desktop"></i>
              <span class="title">Settings</span>
            </a>
            <ul>
              <li class="{!! (isset($classes_menu) && $classes_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('settings/classes/') !!}">
                  <span class="title">Classes</span>
                </a>
              </li>
              <li class="{!! (isset($subjects_menu) && $subjects_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('settings/subjects/') !!}">
                  <span class="title">Subjects</span>
                </a>
              </li>
              <li class="{!! (isset($school_menu) && $school_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('settings/school') !!}">
                  <span class="title">School Settings</span>
                </a>
              </li>
              <li class="{!! (isset($users_menu) && $users_menu == 1)? 'opened active': ''; !!}">
                <a href="{!! url('settings/users/create') !!}">
                  <span class="title">Users</span>
                </a>
              </li>
              <?php if($user->inRole('coder')){ ?>
              <li>
                <a href="{!! url('settings/roles') !!}">
                  <span class="title">Roles &amp; Permissions</span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </li>
    </ul>
        
      </div>
    
    </div>