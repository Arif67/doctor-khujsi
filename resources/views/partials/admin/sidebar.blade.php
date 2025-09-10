
 <aside class="app-sidebar bg-[#222d32] shadow" data-bs-theme="dark">
   <!--begin::Sidebar Brand-->
   <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{route('admin.dashboard')}}" class="brand-link">
      <!--begin::Brand Image-->
      <img
         src="{{asset('assets/img/AdminLTELogo.png')}}"
         alt="AdminLTE Logo"
         class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">AdminLTE 4</span>
      <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
   </div>
   <!--end::Sidebar Brand-->
   <!--begin::Sidebar Wrapper-->
   <div class="sidebar-wrapper">
      <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
         class="nav sidebar-menu flex-column"
         data-lte-toggle="treeview"
         role="menu"
         data-accordion="false"
      >
         <li class="nav-item ">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active':'' }}">
               <i class="nav-icon bi bi-speedometer"></i>
               <p>
                  Dashboard
               </p>
            </a>
         </li>
         <li class="nav-header">Doctor Managment</li>
         <li class="nav-item {{ Route::is('admin.doctors.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>
               Doctor
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.doctors.index')}}" class="nav-link {{ Route::is('admin.doctors.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Doctors</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.doctors.create')}}" class="nav-link {{ Route::is('admin.doctors.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Doctor</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.departments.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link ">
               <i class="nav-icon fas fa-sitemap"></i>
               <p>
                  Department
                  <i class="nav-arrow bi bi-chevron-right"></i>
               </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item ">
                  <a href="{{ route('admin.departments.index') }}" class="nav-link {{ Route::is('admin.departments.index') ? 'active':'' }}"  >
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Departments</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{ route('admin.departments.create') }}" class="nav-link {{ Route::is('admin.departments.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Department</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-header">Patient Managment</li>
         <li class="nav-item {{ Route::is('admin.patients.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>
               Patient
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.patients.index')}}" class="nav-link {{ Route::is('admin.patients.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Patients</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.patients.create')}}" class="nav-link {{ Route::is('admin.patients.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Patient</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-header">Blog Managment</li>
         <li class="nav-item {{ Route::is('admin.categories.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link ">
               <i class="nav-icon fas fa-tags"></i>
               <p>
                  Category
                  <i class="nav-arrow bi bi-chevron-right"></i>
               </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item ">
                  <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Route::is('admin.categories.index') ? 'active':'' }}"  >
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Categories</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{ route('admin.categories.create') }}" class="nav-link {{ Route::is('admin.categories.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Category</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.blogs.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-blog"></i>
            <p>
               Blog
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.blogs.index')}}" class="nav-link {{ Route::is('admin.blogs.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Blogs</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.blogs.create')}}" class="nav-link {{ Route::is('admin.blogs.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Blog</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-header">Theme Customize</li>
         <li class="nav-item {{ Route::is('admin.app.pages.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link ">
               <i class="nav-icon bi bi-copy"></i>
               <p>
                  Pages
                  <i class="nav-arrow bi bi-chevron-right"></i>
               </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item ">
                  <a href="{{ route('admin.app.pages.home') }}" class="nav-link {{ Route::is('admin.app.pages.home') ? 'active':'' }}"  >
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Home</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="" class="nav-link">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>About</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.services.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wrench"></i>
            <p>
               Service
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.services.index')}}" class="nav-link {{ Route::is('admin.services.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Servies</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.services.create')}}" class="nav-link {{ Route::is('admin.services.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Service</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.attentions.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon bi bi-exclamation-triangle"></i>
            <p>
               Attension
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.attentions.index')}}" class="nav-link {{ Route::is('admin.attentions.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Attensions</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.attentions.create')}}" class="nav-link {{ Route::is('admin.attentions.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Attension</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item">
            <a href="{{route('admin.app.setting.edit')}}" class="nav-link {{ Route::is('admin.app.setting.edit') ? 'active':'' }}">
               <i class="nav-icon bi bi-gear"></i>
               <p>
                  App Settings
               </p>
            </a>
         </li>
          <li class="nav-header">Role Permissions</li>
          <li class="nav-item {{ Route::is('admin.roles.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
               Role
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.roles.index')}}" class="nav-link {{ Route::is('admin.roles.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Roles</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.roles.create')}}" class="nav-link {{ Route::is('admin.roles.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Role</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.permissions.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon bi bi-key"></i>
            <p>
               Permission
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.permissions.index')}}" class="nav-link {{ Route::is('admin.permissions.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Permissions</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.doctors.create')}}" class="nav-link {{ Route::is('admin.permissions.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add Permission</p>
                  </a>
               </li>
            </ul>
         </li>
         <li class="nav-item {{ Route::is('admin.users.*') ? 'menu-open':'' }}">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
               User
               <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                  <a href="{{route('admin.users.index')}}" class="nav-link {{ Route::is('admin.users.index') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Users</p>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="{{route('admin.users.create')}}" class="nav-link {{ Route::is('admin.users.create') ? 'active':'' }}">
                     <i class="nav-icon bi bi-circle"></i>
                     <p>Add User</p>
                  </a>
               </li>
            </ul>
         </li>
      </ul>
      <!--end::Sidebar Menu-->
      </nav>
   </div>
   <!--end::Sidebar Wrapper-->
</aside>
