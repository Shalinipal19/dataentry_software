        <div class="card w-100">
            <div class="card-body">
              <div class="position-relative">
                <div class="position-absolute top-100 start-50 translate-middle">
                  <img src="<?= base_url('public/assets/uploads/logo/' .getCompanyData('company_logo')) ?>" width="100" height="100"
                    class="rounded-circle raised p-1 bg-white" alt="">
                </div>
              </div>
              <div class="text-center mt-5 pt-4">
                <h4 class="mb-1"><?= getCompanyData('company_name') ?></h4>
                <p class="mb-0"><?= getCompanyData('company_email') ?></p>
              </div>
              <div class="d-flex align-items-center justify-content-center gap-3 my-5">
                <a href="javascript:;"
                  class="wh-48 bg-linkedin text-white rounded-circle d-flex align-items-center justify-content-center"><i
                    class="bi bi-linkedin fs-5"></i></a>
                <a href="javascript:;"
                  class="wh-48 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"><i
                    class="bi bi-twitter-x fs-5"></i></a>
                <a href="javascript:;"
                  class="wh-48 bg-facebook text-white rounded-circle d-flex align-items-center justify-content-center"><i
                    class="bi bi-facebook fs-5"></i></a>
                <a href="javascript:;"
                  class="wh-48 bg-pinterest text-white rounded-circle d-flex align-items-center justify-content-center"><i
                    class="bi bi-youtube fs-5"></i></a>
              </div>
            
            </div>

            <?php
                $currentUrl=current_url();
                $exUrl=explode('/',$currentUrl);
            ?>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-top <?php if(in_array('company-profile', $exUrl) || in_array('edit-company-profile', $exUrl)) { ?> active <?php } ?>" style="font-size:18px;">
                <a href="<?php echo base_url(); ?>admin/company-profile"><i class="bi bi-person-fill"></i>
                <b>Profile</b></a>
              </li>
              <li class="list-group-item <?php if(in_array('change-password', $exUrl)) { ?> active <?php } ?>" style="font-size:18px;">
                <a href="<?php echo base_url(); ?>admin/change-password"><i class="bi bi-arrow-repeat"></i>

                  <b>Change Password</b></a>
              </li>
              <li class="list-group-item" style="font-size:18px;">
                <a href="<?php echo base_url(); ?>admin/logout"><i class="bi bi-lock-fill"></i><b>Logout</b></a>
              </li>
            </ul>


          </div>