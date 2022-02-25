  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-lightblue">
      {{-- <img src="{{asset('uploads/setting/thumbnail/'.$setting->logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{SITE_NAME}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


          <!-- --------------------------DashBoard --------------------------------------- -->
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.dashboard') }}" class="nav-link @if($activePage=='dashboard') active @endif ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <!-- ---------------------------/DashBoard --------------------------------------- -->

          {{-- <!-- ---------------------------Setting --------------------------------------- -->
          <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link @if($activePage=='setting') active @endif">
                 <i class="nav-icon fas fa-cogs"></i>
              <p>
                Site Setting
              </p>
            </a>
          </li>
          <!-- ---------------------------/Setting --------------------------------------- --> --}}

          {{-- --------------------------New Setting------------------------------- --}}

          <li class="nav-item has-treeview @if(isset($page) && ($page == 'news_list' || $page=='setting_list' ) ) menu-open @endif">
            <a href="#" class="nav-link  @if(isset($page) && ($page == 'news_list' || $page=='setting_list' )) active @endif">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setting.index')}}" class="nav-link @if($activePage=='setting_list') active @endif">
                     <i class="far fa-circle nav-icon"></i>
                  <p>
                    Site Setting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('news.index')}}" class="nav-link @if($activePage=='news_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>News/Notice Setting</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- --------------------------/New Setting------------------------------- --}}

          <!-- ---------------------------Video --------------------------------------- -->


          <li class="nav-item has-treeview @if(isset($page) && $page == 'banner_video') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'banner_video') active @endif">
              <i class="nav-icon fas fa-video"></i>
              <p>
                Video Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('bannerVideo.index')}}" class="nav-link @if($activePage == 'banner_video_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Video Section List</p>
                </a>
              </li>

              

              

            </ul>
          </li>

          <!-- ---------------------------/Video Us--------------------------------------- -->

          <!-- ---------------------------/Gallery --------------------------------------- -->
          
          <li class="nav-item has-treeview @if(isset($page) && $page == 'gallery') menu-open @endif">
            <a href="#" class="nav-link  @if(isset($page) && $page == 'gallery') active @endif">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('gallery.create')}}" class="nav-link @if($activePage=='gallery_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('gallery.index')}}" class="nav-link @if($activePage=='gallery_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- ---------------------------/Gallery --------------------------------------- -->

          <!-- ---------------------------Project--------------------------------------- -->
          <li class="nav-item has-treeview @if(isset($page) && $page == 'project') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'project') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('project.create')}}" class="nav-link @if($activePage == 'project_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('project.index')}}" class="nav-link @if($activePage == 'project_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('up_comming')}}" class="nav-link @if($activePage == 'up_comming_project_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Up-Comming Project List</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- ---------------------------/Project--------------------------------------- -->



          <!-- ---------------------------Product--------------------------------------- -->

          <li class="nav-item has-treeview @if(isset($page) && $page == 'product') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'product') active @endif">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('product.create')}}" class="nav-link @if($activePage == 'product_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link @if($activePage == 'product_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- ---------------------------/Product--------------------------------------- -->




          <!-- ---------------------------Blog--------------------------------------- -->

          <li class="nav-item has-treeview @if(isset($page) && $page == 'blog') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'blog') active @endif">
              <i class="nav-icon fas fa-rss-square"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('blog.create')}}" class="nav-link @if($activePage == 'blog_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('blog.index')}}" class="nav-link @if($activePage == 'blog_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog List</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- ---------------------------/Blog--------------------------------------- -->


          <!-- ---------------------------Client--------------------------------------- -->

          <li class="nav-item has-treeview @if(isset($page) && $page == 'client') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'client') active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Client
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('client-category.index')}}" class="nav-link @if($activePage == 'client_category') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('client.create')}}" class="nav-link @if($activePage == 'client_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('client.index')}}" class="nav-link @if($activePage == 'client_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client List</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- ---------------------------/Client--------------------------------------- -->


          <!-- ---------------------------About Us--------------------------------------- -->


          <li class="nav-item has-treeview @if(isset($page) && $page == 'about') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'about') active @endif">
              <i class="nav-icon fas fa-building"></i>
              <p>
                About Us
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('about.index')}}" class="nav-link @if($activePage == 'About_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us List</p>
                </a>
              </li>

              

              

            </ul>
          </li>

          <!-- ---------------------------/About Us--------------------------------------- -->




           <!-- ---------------------------Services--------------------------------------- -->


           <li class="nav-item has-treeview @if(isset($page) && $page == 'service') menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && $page == 'service') active @endif">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Services 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('service.create')}}" class="nav-link @if($activePage == 'service_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('service.index')}}" class="nav-link @if($activePage == 'service_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service List</p>
                </a>
              </li>

              

              

            </ul>
          </li>

          <!-- ---------------------------/Services --------------------------------------- -->


           <!-- ---------------------------Portfolio--------------------------------------- -->


          <li class="nav-item has-treeview @if(isset($page) && ($page == 'sector_list' || $page=='organization_list')) menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && ($page == 'sector_list' || $page=='organization_list')) active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Portfolio 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('portfolio.index')}}" class="nav-link @if($activePage == 'sector_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sector</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('organization.index')}}" class="nav-link @if($activePage == 'organization_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Organization List</p>
                </a>
              </li>

              

              

            </ul>
          </li>

          <!-- ---------------------------/portfolio --------------------------------------- -->


          <!-- ---------------------------Our Team--------------------------------------- -->

          <li class="nav-item has-treeview @if(isset($page) && ($page == 'team'|| $page == 'our-team')) menu-open @endif">
            <a href="#" class="nav-link @if(isset($page) && ($page == 'team' || $page == 'our-team')) active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Team
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('ourTeam.index')}}" class="nav-link @if($activePage == 'our_team') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our Team Section</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('team.create')}}" class="nav-link @if($activePage == 'team_create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create New Team Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('team.index')}}" class="nav-link @if($activePage == 'team_list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Member List</p>
                </a>
              </li>
            </ul>
          </li>
          

          <!-- ---------------------------/Out Team --------------------------------------- -->

        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
