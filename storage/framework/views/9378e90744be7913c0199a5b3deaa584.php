
<?php $__env->startSection('title', 'Account'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item active">Account</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header b-l-primary">
					<h5>Profile Information</h5>
				</div>
				<div class="card-body">
					<?php if($user->id!=1): ?>
					<h6>Name</h6>
					<p><?php echo e($user->employee->first_name.' '.$user->employee->last_name); ?></p>
					<h6>Email</h6>
					<p><?php echo e($user->email); ?></p>
					<h6>Phone Number</h6>
					<p><?php echo e($user->employee->phone); ?></p>
					<?php endif; ?>
					<h6>Username</h6>
					<p><?php echo e($user->username); ?></p>
					<h6>Role</h6>
					<p><?php echo e($user->getRoleNames()->implode('')); ?></p>
				</div>
			</div>
		</div>
		
		<div class="col-sm-12">
			<div class="card card-absolute">
				<div class="card-header bg-primary">
					<h5 class="text-white">Change Password</h5>
				</div>
				
				<form class="form theme-form" action="<?php echo e(route('password.change')); ?>" method="POST">
	              <?php echo csrf_field(); ?>
				  <div class="card-body">
	              <div class="card-body">
	                <div class="row">
	                  <div class="col">
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">Old Password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="old_password" placeholder="Enter current password">
	                        <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		                        <span class="invalid-feedback" role="alert">
		                            <strong><?php echo e($message); ?></strong>
		                        </span>
		                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                      </div>
	                    </div>
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">New Password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" maxlength="14" placeholder="Enter a new password">
	                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		                        <span class="invalid-feedback" role="alert">
		                            <strong><?php echo e($message); ?></strong>
		                        </span>
		                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                      </div>
	                    </div>
	                    <div class="mb-3 row">
	                      <label class="col-sm-3 col-form-label">Re-enter new password</label>
	                      <div class="col-sm-9">
	                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
	                      </div>
	                    </div>
	                  </div>
	                
						<div class="col-sm-9 offset-sm-3">
							<button class="btn btn-outline-primary" type="submit">Change Password</button>
						</div>
					</div>
	              </div>
				</div>
	            </form>
				
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/account.blade.php ENDPATH**/ ?>