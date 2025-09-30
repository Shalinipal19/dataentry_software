<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Edit Sub Admins</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Edit Sub Admins</h5>
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
											
					<form action="<?= base_url('admin/subadmin/edit-data/' . $getData['id']) ?>" method="POST" id="jQueryValidationForm">
                        <?= csrf_field() ?>
                        
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Sub Admin Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name" value="<?= old('name', $getData['name'] ?? '') ?>" placeholder="Sub Admin Name">
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Sub Admin Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email" value="<?= old('email', $getData['email'] ?? '') ?>" placeholder="Sub Admin Email">
							</div>
						</div>
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="password" name="password" placeholder="*******">
							</div>
						</div>
						 <div class="row mb-3">
							<label class="col-sm-3 col-form-label">Assign Permissions</label>
							<div class="col-sm-9">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Menu</th>
											<th>Add</th>
											<th>Edit</th>
											<th>Delete</th>
											<th>Change Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($menus as $menu): ?>
											<?php 
												$perm = $permissions[$menu['slug']] ?? []; 
												// $permissions array ko controller se bhejna hoga
											?>
											<tr>
												<td><?= $menu['name'] ?></td>
												<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][add]" value="1" <?= !empty($permissions[$menu['slug']]['add']) ? 'checked' : '' ?>></td>
												<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][edit]" value="1" <?= !empty($permissions[$menu['slug']]['edit']) ? 'checked' : '' ?>></td>
												<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][delete]" value="1" <?= !empty($permissions[$menu['slug']]['delete']) ? 'checked' : '' ?>></td>
												<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][status]" value="1" <?= !empty($permissions[$menu['slug']]['status']) ? 'checked' : '' ?>></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
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