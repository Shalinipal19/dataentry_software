<?= $this->extend('admin/layout/auth-layout') ?>
<?= $this->section('content') ?>

    <div class="card-body p-5">        
        <div class="form-body my-5">
            <?php $validation = \Config\Services::validation(); ?>
			<form action="<?= base_url('admin/login') ?>" method="POST" class="row g-3">
                <?= csrf_field() ?>
                <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                        
                    </div>
                <?php endif; ?>
                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail') ?>
                        
                    </div>
                <?php endif; ?>
				<div class="col-12">
					<div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="email" class="form-control" name="email" id="inputEmailAddress" placeholder="jhon@example.com" value="<?= set_value('email') ?>">
                    </div>
                </div>
                <?php if($validation->getError('email')) : ?>
                    <div class="d-block text-danger">
                        <?= $validation->getError('email') ?>
                    </div>
                <?php endif; ?>
				<div class="col-12">
						<div class="input-group" id="show_hide_password">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" value="<?= set_value('password') ?>" placeholder="Enter Password"> 
                                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
						</div>
				</div>
                <?php if($validation->getError('password')) : ?>
                    <div class="d-block text-danger">
                        <?= $validation->getError('password') ?>
                    </div>
                <?php endif; ?>
				<div class="col-12">
					<div class="d-grid">
						<button type="submit" class="btn btn-grd-primary">Login</button>
					</div>
				</div>
            </form>
        </div>
				
    </div>

<?= $this->endSection() ?>