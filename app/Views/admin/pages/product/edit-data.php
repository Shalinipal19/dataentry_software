<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>

    <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
        <div class="breadcrumb-title pe-3">Edit Product</div>
      </div>
    <!--end breadcrumb-->

    <div class="row">
        
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Edit Product</h5>
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
											
					<form action="<?= base_url('admin/product/edit-data/' . $getData['id']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Product Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="product_name" name="product_name" value="<?= old('product_name', $getData['product_name'] ?? '') ?>" placeholder="Product Name here">
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Category Name</label>
							<div class="col-sm-9"> 
                              <select name="category_id" id="multiple-select-field" class="form-select" >
                                <option value="">Choose Category</option>
                                <?php foreach ($getCategories as $row): ?>
                                    <option value="<?= $row['id']; ?>"<?= ($row['id'] == $getData['category_id']) ? 'selected' : ''; ?>><?= $row['category_name']; ?>
                                <?php endforeach; ?>
                              </select>    
                          </div>
						</div>

                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Price</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="price" name="price" value="<?= old('price', $getData['price'] ?? '') ?>" placeholder="Product Price here">
							</div>
						</div>
                        <!-- Radio Buttons for Any Discount -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Any Discount?</label>
                            <div class="col-sm-9 d-flex">
                                <?php 
                                    $any_discount = old('any_discount', $getData['any_discount'] ?? 0);
                                ?>

                                <!-- No -->
                                <div class="form-check me-3">
                                    <input type="radio" class="form-check-input" name="any_discount" id="any_discount2" value="2" onclick="anyDiscount(this.value)" <?= ($any_discount != 1) ? 'checked' : '' ?>
                                    >
                                    <label class="form-check-label" for="any_discount2">No</label>
                                </div>

                                <!-- Yes -->
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="any_discount" id="any_discount1" value="1" onclick="anyDiscount(this.value)" <?= ($any_discount == 1) ? 'checked' : '' ?> checked>
                                    <label class="form-check-label" for="any_discount1">Yes</label>
                                </div>


                            </div>
                        </div>

                        <!-- Discount Section -->
                        <div class="row mb-3 disSec" style="display: none;">
                            <label class="col-sm-3 col-form-label">Discount</label>
                            <div class="col-sm-4">
                                <select name="discount_type" id="discount_type" class="form-select">
                                    <option value="1" <?= (old('discount_type', $getData['discount_type'] ?? '') == 1) ? 'selected' : '' ?>>%</option>
                                    <option value="2" <?= (old('discount_type', $getData['discount_type'] ?? '') == 2) ? 'selected' : '' ?>>₹</option>
                                </select>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="discount" id="discount" class="form-control" value="<?= old('discount', $getData['discount'] ?? '') ?>" placeholder="Enter Discount">
                            </div>
                        </div>

                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Size</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="size" name="size" value="<?= old('size', $getData['size'] ?? '') ?>" placeholder="Product Size here">
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Weight</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="weight" name="weight" value="<?= old('weight', $getData['weight'] ?? '') ?>" placeholder="Product Weight here">
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Product Image</label>
							<div class="col-sm-9">
								<input type="file" name="image" id="image" class="form-control">
                                <?php if (!empty($getData['image'])): ?>
                                    <img src="<?= base_url('public/assets/uploads/product/' . $getData['image']); ?>" alt="Product Image" style="width:100px; height:80px;float:right;  margin-top: 10px;">
                                <?php endif; ?>
							</div>
						</div>
                        <div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="description" name="description"  placeholder="Product Description here"><?= old('description', $getData['description'] ?? '') ?></textarea>
							</div>
						</div>
                        <div class="row mb-3 justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm px-4" style="width: 150px;">Save Product</button>
                        </div>
				
					</form>

				</div>
			</div>
        </div>
    </div>

<?= $this->endSection() ?>
