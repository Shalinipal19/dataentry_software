<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Add Field</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Add Field</h5>
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
											
					<form action="<?= base_url('admin/field/add-data') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Category Name</label>
							<div class="col-sm-9"> 
                              <select name="category_id" id="multiple-select-field" class="form-select" required>
                                <option value="">Choose Category</option>
                                <?php foreach ($getCategories as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                                <?php endforeach; ?>
                              </select>    
                            </div>
						</div>

						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Field Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="field_name" name="field_name"  placeholder="Field Name here">
							</div>
						</div>
                        
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Field Type</label>
							<div class="col-sm-9"> 
                                <select name="field_type" id="field_type" class="form-select">
                                    <option value="text">text</option>
                                    <option value="email">email</option>
                                    <option value="tel">tel</option>
                                    <option value="date">date</option>
                                    <option value="number">number</option>
                                    <option value="checkbox">checkbox</option>
                                    <option value="radio">radio</option>
                                    <option value="dropdown">dropdown</option>
                                    <option value="file">file</option>
                                    <option value="multi select">multi select</option>
                                    <option value="textarea">textarea</option>
                                </select>       
                            </div>
						</div>

                        <div class="row mb-3 justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm px-4" style="width: 150px;">Save</button>
                        </div>
				
					</form>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>