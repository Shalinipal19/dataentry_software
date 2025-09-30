<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Change Profile</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-4 d-flex">
          <?php echo view('admin/layout/inc/admin-sidebar'); ?>
        </div>

        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3 d-flex justify-content-between">
					<h5 class="mb-0">Change Password</h5>
					 <?php if (session()->get('role') != 2): ?>
					 <a href="<?= base_url('admin/edit-company-profile') ?>" type="submit" class="btn btn-success">Edit</a>
					 <?php endif; ?>
					</div>
				<div class="card-body p-4">
                  
                    <?php if(isset($validation)): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors(); ?>
                        </div>
                        <?php endif; ?>

						<?php if(session()->getFlashdata('error')!=''): ?>
							<div class="alert alert-danger">
								<?= session()->getFlashdata('error'); ?>
							</div>
						<?php endif; ?>

						<?php if(session()->getFlashdata('success')!=''): ?>
							<div class="alert alert-success">
								<?= session()->getFlashdata('success'); ?>
							</div>
						<?php endif; ?>

						<?php if(session()->getFlashdata('warning')!=''): ?>
							<div class="alert alert-warning">
								<?= session()->getFlashdata('warning'); ?>
							</div>
						<?php endif; ?>
											
							<table class="table mb-0">
								<tbody>
									<tr>
										<th scope="row">Company Name</th>
										<td>: <?= $getData[0]['company_name']; ?></td>
									</tr>
									<tr>
										<th scope="row">Company Email</th>
										<td>: <?= $getData[0]['company_email']; ?></td>
									</tr>
									<tr>
										<th scope="row">Company Contact</th>
										<td>: <?= $getData[0]['company_contact']; ?></td>
									</tr>
									<tr>
										<th scope="row">Company Whatsapp Number</th>
										<td>: <?= $getData[0]['company_whatsapp']; ?></td>
									</tr>
									<tr>
										<th scope="row">Company Address</th>
										<td>: <?= $getData[0]['company_address']; ?></td>
									</tr>
									<tr>
										<?php if($getData[0]['company_logo']!=""): ?>
											<?php 
                                                $companyLogo=$getData[0]['company_logo']; ?>
                                            
										<th scope="row">Company Logo</th>
										<td>: <img src="<?= base_url('public/assets/uploads/logo/' . $companyLogo) ?>" style="height:80px; width:80px;">
        								</td>
										<?php endif; ?>
									</tr>	
								</tbody>
							</table>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>