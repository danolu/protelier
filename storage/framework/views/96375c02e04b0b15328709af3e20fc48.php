
<?php $__env->startSection('title', 'Services'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Services</li>
<li class="breadcrumb-item active">All</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Services</h5>
               <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit services')): ?>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createservice">+ New Service</a>
               <?php endif; ?>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit services')): ?>
            <div class="modal fade" id="createservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create New Service</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="<?php echo e(route('services.store')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Name*:</label>
                              <input class="form-control" type="text" name="name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Unit Price (N)*:</label>
                              <input class="form-control" type="number" name="price" required>
                           </div>
                            <div class="mb-3">
                              <label class="col-form-label">Status*</label>
                              <div class="input-group">
                                 <select class="form-control" name='status' required="">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Cost</th>
                           <th>Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($service->name); ?></td>
                           <td><?php echo e($service->price); ?></td>
                           <td><?php if($service->status==1): ?> <span class="text-success">Active</span> <?php else: ?> <span class="text-danger">Inactive</span> <?php endif; ?></td>
                           <td>
                              <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#book<?php echo e($service->id); ?>">Book</a> 
                              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit services')): ?>
                              <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#edit<?php echo e($service->id); ?>">Edit</a>
                              <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($service->id); ?>">Delete</a>
                              <?php endif; ?>
                           </td>
                        </tr>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit services')): ?>
                        <div class="modal fade" id="delete<?php echo e($service->id); ?>" tabindex="-1" role="dialog" aria-labelledby="delete<?php echo e($service->id); ?>" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete <?php echo e($service->name); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete <?php echo e($service->name); ?>?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="<?php echo e(route('services.destroy', $service->id)); ?>" method="POST">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Service</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="edit<?php echo e($service->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Edit <?php echo e($service->name); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="<?php echo e(route('services.update', $service->id)); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <?php echo method_field('patch'); ?>
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Name*:</label>
                                          <input class="form-control" type="text" value="<?php echo e($service->name); ?>" name="name" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Unit Price (N)*:</label>
                                          <input class="form-control" type="number" value="<?php echo e($service->price); ?>" name="price" required>
                                       </div>
                                        <div class="mb-3">
                                          <label class="col-form-label">Status*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='status' required="">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <?php endif; ?>
                        <div class="modal fade" id="book<?php echo e($service->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Book <?php echo e($service->name); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="<?php echo e(route('services.book')); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                       <input class="form-control" type="hidden" name="service" value="<?php echo e($service->name); ?>" required>
                                       <div class="mb-3">
                                          <label class="col-form-label">Customer*:</label>
                                          <input class="form-control" type="text" name="customer" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Unit Price (N)*:</label>
                                          <input class="form-control" type="number" value="<?php echo e($service->price); ?>" name="price" readonly required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Quantity*:</label>
                                          <input class="form-control" type="number" name="quantity" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Discount (N)*:</label>
                                          <input class="form-control" type="number" name="discount" value="0" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Payment Method*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='method' required="">
                                                <option value="Transfer">Transfer</option>
                                                <option value="POS">POS</option>
                                                <option value="Cash">Cash</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                       <button class="btn btn-primary" type="submit">Book</button>
                                    </div>
                                 </form>
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
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/services.blade.php ENDPATH**/ ?>