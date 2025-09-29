<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

<div id="stepper1" class="bs-stepper">
  <div class="card">
    <div class="card-body">
      <div class="bs-stepper-content">
        <form action="<?= base_url('admin/reports/search') ?>" method="POST">
            <?= csrf_field() ?>
          <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
            <h5 class="mb-4">Filter Report</h5>
            
              <div class="row g-3">
                <div class="col-12 col-lg-3">
                  <select class="form-select" name="year" id="yearType">
                      <option value="">-- Select Type --</option>
                      <option value="0">Yearly</option>
                      <option value="1">Monthly</option>
                      <option value="2">Custom range</option>
                  </select>
              </div>

              <!-- Year selection -->
              <div class="col-12 col-lg-3 d-none" id="yearBox">
                  <select class="form-select" name="selected_year">
                      <option value="">Select Year</option>
                      <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
                          <option value="<?= $y ?>"><?= $y ?></option>
                      <?php endfor; ?>
                  </select>
              </div>

              <div class="col-12 col-lg-3 d-none" id="monthBox">
                <select class="form-select" name="selected_month">
                    <option value="">Select Month</option>
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?= $m ?>"><?= date("F", mktime(0, 0, 0, $m, 1)) ?></option>
                    <?php endfor; ?>
                </select>
              </div>

              <!-- Custom range -->
              <div class="col-12 col-lg-3 d-none" id="startDateBox">
                  <input type="date" class="form-control" name="start_date">
              </div>
              <div class="col-12 col-lg-3 d-none" id="endDateBox">
                  <input type="date" class="form-control" name="end_date">
              </div>

              <div class="col-12 col-lg-3">
                <select class="form-select" name="category_id">
                  <option value="">Select Category</option>
                  <?php foreach($categories as $cat): ?>
                      <option value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-12 col-lg-3">
                <input type="text" class="form-control" name="field_value" placeholder="Search Field Value">
              </div>
              <div class="col-12 col-lg-6 mt-3">
                <button class="btn btn-success px-5">Submit <i class='bx bx-right-arrow-alt ms-2'></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
   </div>
</div>
<?php if (!empty($reports)): ?>
  <div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="" class="mb-4">
          <input type="hidden" name="year" value="<?= esc($yearType ?? '') ?>">
          <input type="hidden" name="selected_year" value="<?= esc($selected_year ?? '') ?>">
          <input type="hidden" name="selected_month" value="<?= esc($selected_month ?? '') ?>">
          <input type="hidden" name="start_date" value="<?= esc($start_date ?? '') ?>">
          <input type="hidden" name="end_date" value="<?= esc($end_date ?? '') ?>">
          <input type="hidden" name="category_id" value="<?= esc($category_id ?? '') ?>">
          <input type="hidden" name="field_value" value="<?= esc($field_value ?? '') ?>">

          <button type="submit" formaction="<?= base_url('admin/reports/exportExcel') ?>" class="btn btn-outline-danger px-5">Excel</button>
          <button type="submit" formaction="<?= base_url('admin/reports/exportPdf') ?>" class="btn btn-outline-success px-5">PDF</button>
        </form>
        <table class="table table-bordered mb-0">
          <thead>
            
            <tr>
              <th>#</th>
              <th>Category Name</th>
              <th>Field Name</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($reports)): ?>
            <?php foreach ($reports as $key => $row): ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $row['category_name'] ?></td>
                <td><?= $row['field_name'] ?></td>
                <td><?= $row['form_data'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4">No records found</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      
    
    </div>
  </div>
<?php endif; ?>
<?= $this->endSection() ?>
