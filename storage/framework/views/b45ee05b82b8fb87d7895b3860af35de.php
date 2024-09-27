<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Settings</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item active">Settings</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-xl-6 xl-100">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Hotel Information</h5>
                </div>
                <form class="form theme-form" action="<?php echo e(route('hotel.update')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Hotel Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" name="name" value="<?php echo e($hotel->name); ?>" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Tagline</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="e.g 'your best place to be'" value="<?php echo e($hotel->tagline); ?>" name="tagline">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="<?php echo e($hotel->address); ?>" required="" name="address">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input class="form-control digits" type="tel" name="phone" value="<?php echo e($hotel->phone); ?>" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Alternate Phone Number</label>
                          <div class="col-sm-9">
                            <input class="form-control m-input digits" type="tel" name="alt_phone" value="<?php echo e($hotel->alt_phone); ?>">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="email" value="<?php echo e($hotel->email); ?>" name="email" required="">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Alternative Email</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="email" value="<?php echo e($hotel->alt_email); ?>" name="alt_email">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Website</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="<?php echo e($hotel->website); ?>" placeholder="e.g. 'hotel.com'" name="website">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Hotel's Bank Details</h5>
                </div>
                <form class="form theme-form" action="<?php echo e(route('bank.update')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" placeholder="e.g. Zenith Bank" name="bank_name" value="<?php echo e($hotel->bank_name); ?>">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Account Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" value="<?php echo e($hotel->account_name); ?>" name="account_name">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label class="col-sm-3 col-form-label">Bank Account Number</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="number" value="<?php echo e($hotel->account_number); ?>" name="account_number">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <h5>Customer Loyalty Settings</h5>
                </div>
                <form class="form theme-form" action="<?php echo e(route('loyalty.update')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3 row mb-0">
                          <label class="col-sm-3 col-form-label">Loyalty Percentage</label>
                          <div class="col-sm-9">
                            <input value="<?php echo e($hotel->loyalty_fraction); ?>" class="form-control" required name="loyalty_fraction" placeholder="Enter percentage of guest purchase that goes to loyalty bonus." />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-outline-primary" type="submit">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/settings.blade.php ENDPATH**/ ?>