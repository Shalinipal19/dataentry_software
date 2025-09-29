<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Edit Company Profile</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-4 ">
          <?php echo view('admin/layout/inc/admin-sidebar'); ?>
        </div>

        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Edit Company Profile</h5>
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
											
					<form action="<?= base_url('admin/edit-company-profile') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="row_id" value="<?= $getData['id'] ?? '' ?>"/>
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Company Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="company_name" name="company_name"  value="<?= set_value('company_name', $getData['company_name'] ?? ''); ?>" placeholder="Company Name here">
								<?= isset($errors['company_name']) ? $errors['company_name'] : ''; ?>
							</div>
						</div>
                        
						<div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="company_email" name="company_email" value="<?= set_value('company_email', $getData['company_email'] ?? ''); ?>" placeholder="Company Email here">
								<?= isset($errors['company_email']) ? $errors['company_email'] : ''; ?>
							</div>
						</div>
                        
                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Contact</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="company_contact" name="company_contact" value="<?= set_value('company_contact', $getData['company_contact'] ?? ''); ?>" placeholder="Company Contact here">
								<?= isset($errors['company_contact']) ? $errors['company_contact'] : ''; ?>
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Whatsapp</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="company_whatsapp" name="company_whatsapp" value="<?= set_value('company_whatsapp', $getData['company_whatsapp'] ?? ''); ?>" placeholder="Company Whatsapp here">
								<?= isset($errors['company_address']) ? $errors['company_address'] : ''; ?>
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Address</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="company_address" name="company_address" placeholder="Company Address here"><?= set_value('company_address', $getData['company_address'] ?? '') ?></textarea>
								<?= isset($errors['company_address']) ? $errors['company_address'] : ''; ?>
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Facebook Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="facebook_link" name="facebook_link" value="<?= set_value('facebook_link', $getData['facebook_link'] ?? ''); ?>" placeholder="Company Facebook link here">
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Instagram Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="instagram_link" name="instagram_link" value="<?= set_value('instagram_link', $getData['instagram_link'] ?? ''); ?>" placeholder="Company Instagram link here">
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">LinkedIn Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="linkedin_link" name="linkedin_link" value="<?= set_value('linkedin_link', $getData['linkedin_link'] ?? ''); ?>" placeholder="Company Linkedin link here">
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Youtube Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="youtube_link" name="youtube_link" value="<?= set_value('youtube_link', $getData['youtube_link'] ?? ''); ?>" placeholder="Company Youtube link here">
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Twitter Link</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="twitter_link" name="twitter_link" value="<?= set_value('twitter_link', $getData['twitter_link'] ?? ''); ?>" placeholder="Company Twitter link here">
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Logo</label>
							<div class="col-sm-9">
								<input class="form-control" name="company_logo" type="file" id="company_logo">
                                <?php if (!empty($getData['company_logo'])): ?>
                                    <img src="<?= base_url('public/assets/uploads/logo/'.$getData['company_logo']) ?>" 
                                        style="width:100px; float:right">
                                <?php endif; ?>
                                <?= isset($errors['company_logo']) ? $errors['company_logo'] : ''; ?>
							</div>
						</div>

                        <div class="row mb-3">
							<label for="input36" class="col-sm-3 col-form-label">Company Favicon</label>
							<div class="col-sm-9">
								<input class="form-control" name="company_favicon" type="file" id="company_favicon">
                                <?php if (!empty($getData['company_favicon'])): ?>
                                    <img src="<?= base_url('public/assets/uploads/logo/'.$getData['company_favicon']) ?>" 
                                        style="width:100px; float:right">
                                <?php endif; ?>
                                <?= isset($errors['company_favicon']) ? $errors['company_favicon'] : ''; ?>
							</div>
						</div>

                        <div class="row mb-3 justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm px-4" style="width:120px;">Submit</button>
                        </div>
				
					</form>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>