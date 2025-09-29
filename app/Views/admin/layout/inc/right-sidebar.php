<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div class="logo-icon">
      <img src="<?= base_url('public/assets/uploads/logo/' .getCompanyData('company_logo')) ?>" <?= getCompanyData('company_name') ?> class="logo-img" alt="<?= getCompanyData('company_name') ?>">
    </div>
    <div class="logo-name flex-grow-1">
      <!-- <h5 class="mb-0">Maxton</h5> -->
    </div>
    <div class="sidebar-close">
      <span class="material-icons-outlined">close</span>
    </div>
  </div>
  <div class="sidebar-nav">
      <!--navigation-->
      <ul class="metismenu" id="sidenav">    
          <?php $menus = getSidebarMenus(); ?>
          <?php foreach($menus as $menu): ?>
              <li>
                  <a href="<?= base_url('admin/'.$menu['slug']) ?>">
                      <div class="parent-icon"><i class="material-icons-outlined">apps</i></div>
                      <div class="menu-title"><?= $menu['name'] ?></div>
                  </a>
              </li>
          <?php endforeach; ?>
      </ul>
      <!--end navigation-->
  </div>
</aside>