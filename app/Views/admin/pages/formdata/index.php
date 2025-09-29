<?= $this->extend('admin/layout/pages-layout') ?>
<?= $this->section('content') ?>
    <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
					<div class="breadcrumb-title pe-3">Form Data List</div>
					<div class="ms-auto">
						<div class="btn-group">
							<?php if(isset($permission) && $permission->can_add == 1): ?>
								<a href="<?= base_url('admin/formdata/add-data') ?>" type="button" class="btn btn-primary">Add Form Data</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
                <div class="card">
					<div class="card-body">
						<div id="msgDivAjax"></div>
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
										<th class="text-center">Category Name</th>
										<th class="text-center">Form Data</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"></th>
									</tr>
								</thead>
								<tbody>
									<?php $a=1; ?>
                                    <?php foreach ($getData as $row): ?>
									<tr id="tr_<?= $row['id']; ?>" class="text-center">
										<td><?= $a ?></td>
										<td><?= $row['category_name'] ?></td>
                                        <td><?= $row['field_name'] ?></td>
										
										<td id="st_<?= $row['id'] ?>">
											<?php if(isset($permission) && $permission->can_status == 1): ?>
												<?php if ($row['status'] == '1'): ?>
													<span class="badge bg-success"style="cursor:pointer;" onclick="changeStatus('formdata','deactivate',<?php echo $row['id']; ?>)">Active</span>
												<?php else: ?>
													<span class="badge bg-danger"style="cursor:pointer;" onclick="changeStatus('formdata','activate',<?php echo $row['id']; ?>)">Inactive</span>
												<?php endif; ?>
											<?php else: ?>
												<?php if($row['status']=='1'): ?>
													<span class="badge bg-success" style="cursor:not-allowed;">Active</span>
												<?php else: ?>
													<span class="badge bg-danger" style="cursor:not-allowed;">Inactive</span>
												<?php endif; ?>
											<?php endif; ?>
                                        </td>
										<td>
											<?php if(isset($permission) && $permission->can_edit == 1): ?>
											<a href="<?= site_url('/admin/formdata/edit-data/' . $row['id']) ?>" class="btn btn-info btn-rounded btn-icon btn-action">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
											<?php endif; ?>
											<?php if(isset($permission) && $permission->can_delete == 1): ?>
                                            <a  onclick="deleteData('formdata',<?= $row['id']; ?>)" class="btn btn-info btn-rounded btn-icon btn-action" style="cursor:pointer">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
											<?php endif; ?>
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