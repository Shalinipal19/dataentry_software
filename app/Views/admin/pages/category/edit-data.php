<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Edit Category</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Edit Category</h5>
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
											
					<form action="<?= base_url('admin/category/edit-data/' . $getData['id']) ?>" method="POST" id="jQueryValidationForm">
                        <?= csrf_field() ?>
                        
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Category Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="category_name" name="category_name" value="<?= old('category_name', $getData['category_name'] ?? '') ?>" placeholder="Category Name">
							</div>
						</div>
                        
                        <div class="row mb-3 justify-content-center">
                        <button type="submit" class="btn btn-success px-4" style="width: auto;">Update Category</button>
                        </div>				
					</form>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>