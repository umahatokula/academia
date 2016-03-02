<!-- Left links for user info navbar -->
        <ul class="user-info-menu left-links list-inline list-unstyled">
      
          <li class="hidden-sm hidden-xs">
            <a href="#" data-toggle="sidebar">
              <i class="fa-bars"></i>
            </a>
          </li>
      
          <!-- Added in v1.2 -->
          <li class="dropdown hover-line language-switcher">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{!! asset('assets/images/flags/flag-uk.png') !!}" alt="flag-uk" />
              English
            </a>
      
            <ul class="dropdown-menu languages">
              <li>
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-al.png') !!}" alt="flag-al" />
                  Shqip
                </a>
              </li>
              <li class="active">
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-uk.png') !!}" alt="flag-uk" />
                  English
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-de.png') !!}" alt="flag-de" />
                  Deutsch
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-fr.png') !!}" alt="flag-fr" />
                  Fran&ccedil;ais
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-br.png') !!}" alt="flag-br" />
                  Portugu&ecirc;s
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{!! asset('assets/images/flags/flag-es.png') !!}" alt="flag-es" />
                  Espa&ntilde;ol
                </a>
              </li>
            </ul>
          </li>
      
        </ul>
      
      
        <!-- Right links for user info navbar -->
        <ul class="user-info-menu right-links list-inline list-unstyled">
              <li class="search-form"><!-- You can add "always-visible" to show make the search input visible -->
      
            <form name="userinfo_search_form" method="get" action="extra-search.html">
              <input type="text" name="s" class="form-control search-field" placeholder="Type to search..." />
      
              <button type="submit" class="btn btn-link">
                <i class="linecons-search"></i>
              </button>
            </form>
      
          </li>
      
          <li class="dropdown user-profile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{!! asset('assets/images/staff/'.\Session::get('user')->staff_id.'.jpg') !!}" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
              <span>
                {!! Sentinel::getUser()->first_name !!}
                <i class="fa-angle-down"></i>
              </span>
            </a>
      
            <ul class="dropdown-menu user-profile-menu list-unstyled">
              <li>
                <a href="{!! route('admin.staff.show', array(Sentinel::getUser()->staff_id )) !!}">
                  <i class="fa-user"></i>
                  Profile
                </a>
              </li>
              <!-- li>
                <a href="#help">
                  <i class="fa-info"></i>
                  Help
                </a>
              </li> -->
              <li class="last">
                <a href="{!! route('logout') !!}">
                  <i class="fa-lock"></i>
                  Logout
                </a>
              </li>
            </ul>
          </li>
      
         <!--  <li>
            <a href="#" data-toggle="chat">
              <i class="fa-comments-o"></i>
            </a>
          </li> -->
      
        </ul>