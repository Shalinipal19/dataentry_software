<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>
<!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Admin Dashboard</div>
      </div>
        <div class="row g-4"> 
          
          <div class="col-xl-6 col-xxl-3 align-items-stretch">
            <div class="card w-100 rounded-4" style="background-image: linear-gradient(310deg, #ee0979, #ff6a00) !important;">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0" style="color:#fff;">Total Count</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-middle">
                       <thead>
                        <tr>
                          <th style="color:#fff;">Category Count</th>
                          <th style="color:#fff;"><?= $categoryCount ?></th>
                        </tr>
                       </thead>
                      </table>
                    </div>
                  </div>
            </div>
          </div>
          <div class="col-xl-6 col-xxl-3 align-items-stretch">
            <div class="card w-100 rounded-4" style="background-image: linear-gradient(310deg, #7928ca, #ff0080) !important;">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0" style="color:#fff;">Total Category Count</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-middle">
                       <thead>
                         <?php if (!empty($categoryWise)): ?>
                            <?php foreach ($categoryWise as $cat): ?>
                              <tr>
                                <td style="color:#fff;"><?= esc($cat['category_name']) ?></td>
                                <td style="color:#fff;"><?= esc($cat['total_entries']) ?></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="2" class="text-center">No data found</td>
                            </tr>
                          <?php endif; ?>
                       </thead>
                      </table>
                    </div>
                  </div>
            </div>
          </div>
          
          <div class="col-xl-6 col-xxl-6 align-items-stretch">
            <div class="card w-100 rounded-4" style="background-image: linear-gradient(310deg, #3494e6, #ec6ead) !important;">
              <div class="card-body">
               <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0" style="color:#fff;">Recent Data Entry</h5>
                  </div>
                </div>
                
                 <div class="table-responsive">
                     <table class="table align-middle">
                       <thead>
                        <tr>
                          <th style="color:#fff;">#</th>
                          <th style="color:#fff;">Category Name</th>
                          <th style="color:#fff;">Label</th>
                          <th style="color:#fff;">Data</th>
                        </tr>
                        <?php $a=1; ?>
                        <?php if (!empty($entries)): ?>
                            <?php foreach ($entries as $entry): ?>
                                <tr id="tr_<?= $entry['id']; ?>">
                                    <td style="color:#fff;"><?= $a ?></td>
                                    <td style="color:#fff;"><?= esc($entry['category_name']) ?></td>
                                    <td style="color:#fff;"><?= esc($entry['field_label']) ?></td>
                                    <td style="color:#fff;"><?= esc($entry['form_data']) ?></td>
                                </tr>
                                <?php $a++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr>
                        <?php endif; ?>
                       </thead>
                     </table>
                 </div>
              </div>
            </div>
          </div>
          
        </div>
        
      <!--end breadcrumb-->
<?= $this->endSection() ?>