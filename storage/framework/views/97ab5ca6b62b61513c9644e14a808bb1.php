
<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">All</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Users</h5>
               <a class="btn btn-primary" href="<?php echo e(route('users.create')); ?>">+ New User</a>
            </div>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Name</th>
                           <th>Username</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e(++$k); ?></td>
                           <td><?php echo e($user->employee->first_name.' '.$user->employee->last_name); ?></td>
                           <td><?php echo e($user->username); ?></td>
                           <td><?php echo e($user->email); ?></td>
                           <td><?php echo e($user->getRoleNames()->implode('')); ?></td>
                           <td>
                              <a class="btn btn-info btn-xs" href="<?php echo e(route('users.edit', $user->id)); ?>">Edit</a>
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($user->id); ?>">Delete</a>
                           </td>
                        </tr>
                        <div class="modal fade" id="delete<?php echo e($user->id); ?>" tabindex="-1" role="dialog" aria-labelledby="delete<?php echo e($user->id); ?>" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete <?php echo e('@'.$user->username); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete <?php echo e('@'.$user->username); ?>?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Room</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- Individual column searching (text inputs) Ends-->
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/product-list-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/users/index.blade.php ENDPATH**/ ?>