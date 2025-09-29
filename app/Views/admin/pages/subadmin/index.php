<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
					<div class="breadcrumb-title pe-3">Sub Admin List</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="<?= base_url('admin/add-subadmin') ?>" type="button" class="btn btn-primary">Add Sub Admins</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
                <div class="card">
					<div class="card-body">
						<?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php elseif (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
						<div class="table-responsive">
                            <div id="msgDivAjax"></div>
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Name</th>
										<th class="text-center">Email</th>
										<th class="text-center">Status</th>
										<th class="text-center"></th>
									</tr>
								</thead>
								<tbody>
									<?php $a=1; ?>
                                    <?php foreach ($getData as $row): ?>
									<tr id="tr_<?= $row['id']; ?>" class="text-center">
										<td><?= $a ?></td>
										<td><?= $row['name'] ?></td>
										<td><?= $row['email'] ?></td>
										<td id="st_<?= $row['id'] ?>">
                                            <?php if ($row['status'] == '1'): ?>
                                                <span class="badge bg-success"style="cursor:pointer;" onclick="changeStatus('subadmin','deactivate',<?php echo $row['id']; ?>)">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger"style="cursor:pointer;" onclick="changeStatus('subadmin','activate',<?php echo $row['id']; ?>)">Inactive</span>
                                            <?php endif; ?>
                                        </td>
										<td>
                                            <a href="<?= base_url('admin/subadmin/edit-data/' . $row['id']) ?>" class="btn btn-info btn-rounded btn-icon btn-action">
                                                <i class="mdi mdi-grease-pencil"></i>
                                            </a>
                                            <a  onclick="deleteData('subadmin',<?= $row['id']; ?>)" class="btn btn-info btn-rounded btn-icon btn-action" style="cursor:pointer">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
									</tr>
									<?php $a++; ?>
                                    <?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
<?= $this->endSection() ?>