<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Add Sub Admin</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Add Sub Admin</h5>
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
											
					<form action="<?= base_url('admin/add-subadmin') ?>" method="POST">
                        <?= csrf_field() ?>
                        
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Sub Admin Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="name" name="name"  placeholder="Sub Admin Name here">
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Sub Admin Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email"  placeholder="Sub Admin Email here">
							</div>
						</div>
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password">
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
										<tr>
											<td><?= $menu['name'] ?></td>
											<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][add]" value="1"></td>
											<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][edit]" value="1"></td>
											<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][delete]" value="1"></td>
											<td><input type="checkbox" name="permissions[<?= $menu['slug'] ?>][status]" value="1"></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
                        <div class="row mb-3 justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm px-4" style="width: auto;">Add Sub Admin</button>
                        </div>
				
					</form>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>