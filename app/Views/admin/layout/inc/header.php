 <header class="top-header">
  <nav class="navbar navbar-expand align-items-center gap-4">
    <div class="btn-toggle">
      <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
    </div>
    <div class="search-bar flex-grow-1">
      
      </div>
    </div>
    <ul class="navbar-nav gap-1 nav-right-links align-items-center">
      <li class="nav-item dropdown">
        <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
           <img src="<?= base_url('public/assets/uploads/logo/' .getCompanyData('company_logo')) ?>" class="rounded-circle p-1 border" width="45" height="45" alt="">
        </a>
        <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
          
          <hr class="dropdown-divider">
          <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?= base_url('admin/company-profile') ?>"><i
            class="material-icons-outlined">person_outline</i>Profile</a>
          <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?= base_url('admin/change-password') ?>"><i
            class="material-icons-outlined">autorenew</i>Change Password</a>
          <hr class="dropdown-divider">
          <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?= base_url('admin/logout') ?>"><i
          class="material-icons-outlined">power_settings_new</i>Logout</a>
        </div>
      </li>
    </ul>

  </nav>
</header>