<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
					<div class="breadcrumb-title pe-3">Product</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="<?= base_url('admin/product/add-data') ?>" type="button" class="btn btn-primary">Add Product</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
                <div class="card">
					<div class="card-body">
						<div class="table-responsive">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php elseif (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Product Name</th>
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center">Discount</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Image</th>
										<th class="text-center">Status</th>
										<th class="text-center"></th>
									</tr>
								</thead>
								<tbody>
                                    <?php foreach ($getData as $row): ?>
									<tr class="text-center">
										<td><?= $row['id'] ?></td>
										<td><?= $row['product_name'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td>
                                            <?php
                                                $discountText = '';
                                                if ($row['discount_type'] == 1) {
                                                    $discountText = $row['discount'] . '%';
                                                } elseif ($row['discount_type'] == 2) {
                                                    $discountText = '₹' . $row['discount'] . '';
                                                }
                                            ?>
                                            <?= $discountText ?: '---' ?>
                                        </td>

                                        <td>
                                            <?php if ($row['discount_type'] != 0): ?>
                                                <span style="text-decoration: line-through; color: gray;">₹<?= esc($row['price']) ?></span><br>
                                                <span style="font-weight: bold; color: black;">₹<?= round($row['offer_price']) ?></span>
                                            <?php else: ?>
                                                <span>₹<?= esc($row['price']) ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($row['image']): ?>
                                                <img src="<?= base_url('public/assets/uploads/product/' . $row['image']) ?>" width="50" height="50" alt="Product Image">
                                            <?php endif; ?>
                                        </td>
										<td id="st_<?= $row['id'] ?>">
                                            <?php if ($row['status'] == '1'): ?>
                                                <span class="badge bg-success"style="cursor:pointer;" onclick="changeStatus('category','deactivate', <?= $row['id'] ?>)">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"style="cursor:pointer;"onclick="changeStatus('category','activate', <?= $row['id'] ?>)">Inactive</span>
                                            <?php endif; ?>
                                        </td>
										<td>
                                            <a href="<?= site_url('/admin/product/edit-data/' . $row['id']) ?>" class="btn btn-info btn-rounded btn-icon btn-action">
                                                <i class="mdi mdi-grease-pencil"></i>
                                            </a>
                                            <a href="<?= site_url('/admin/category/delete/' . $row['id']) ?>" style="cursor:pointer" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger btn-rounded btn-icon btn-action">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
									</tr>
                                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
<?= $this->endSection() ?>