<?php $__env->startSection('title', 'Room Types'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item active">Room Types</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Room Types</h5>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createroomtype">+ New Room Type</a>
            </div>
            <div class="modal fade" id="createroomtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Room Type</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="<?php echo e(route('roomtypes.store')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Name*:</label>
                              <input class="form-control" type="text" name="name" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Number of beds*:</label>
                              <input class="form-control" type="number" name="number_of_beds" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Rate(N)*:</label>
                              <input class="form-control" type="number" name="rate" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Caution(N)*:</label>
                              <input class="form-control" type="number" name="caution" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Bed Type:</label>
                              <input class="form-control" type="text" name="bed_type">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Adult Capacity*:</label>
                              <input class="form-control" type="number" name="adult_capacity" required="">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Children Capacity*:</label>
                              <input class="form-control" type="number" name="children_capacity" required="">
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Description:</label>
                              <textarea class="form-control" type="text" name="description"></textarea> 
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
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>S/N</th>
                           <th>Name</th>
                           <th>Rate</th>
                           <th>Caution</th>
                           <th>Adult</th>
                           <th>Children</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $__currentLoopData = $roomtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e(++$k); ?></td>
                           <td><?php echo e($roomtype->name); ?></td>
                           <td>N<?php echo e(number_format($roomtype->rate)); ?></td>
                           <td>N<?php echo e(number_format($roomtype->caution)); ?></td>
                           <td><?php echo e($roomtype->adult_capacity); ?></td>
                           <td><?php echo e($roomtype->children_capacity); ?></td>
                           <td>
                              <a class="btn btn-success btn-xs" target="_blank" href="<?php echo e(route('roomtypes.show', $roomtype->id)); ?>">View</a>
                              <a class="btn btn-info btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#edit<?php echo e($roomtype->id); ?>">Edit</a>
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($roomtype->id); ?>">Delete</a>
                           </td>
                        </tr>
                        <div class="modal fade" id="delete<?php echo e($roomtype->id); ?>" tabindex="-1" role="dialog" aria-labelledby="delete<?php echo e($roomtype->id); ?>" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Delete <?php echo e($roomtype->name); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete <?php echo e($roomtype->name); ?>?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="<?php echo e(route('roomtypes.destroy', $roomtype->id)); ?>" method="POST">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="edit<?php echo e($roomtype->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo e($roomtype->name); ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <form action="<?php echo e(route('roomtypes.update', $roomtype->id)); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <?php echo method_field('patch'); ?>
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Name*:</label>
                                          <input class="form-control" value="<?php echo e($roomtype->name); ?>" type="text" name="name" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Number of beds*:</label>
                                          <input class="form-control" type="number" value="<?php echo e($roomtype->number_of_beds); ?>" name="number_of_beds" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Rate(N)*:</label>
                                          <input class="form-control" type="number" name="rate" value="<?php echo e($roomtype->rate); ?>" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Caution(N)*:</label>
                                          <input class="form-control" type="number" name="caution" value="<?php echo e($roomtype->caution); ?>" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Bed Type:</label>
                                          <input class="form-control" type="text" name="bed_type" value="<?php echo e($roomtype->bed_type); ?>">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Adult Capacity*:</label>
                                          <input class="form-control" type="number" name="adult_capacity" value="<?php echo e($roomtype->adult_capacity); ?>" required="">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Children Capacity*:</label>
                                          <input class="form-control" type="number" name="children_capacity" value="<?php echo e($roomtype->children_capacity); ?>" required="">
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Description:</label>
                                          <textarea class="form-control" type="text" name="description"><?php echo e($roomtype->description); ?></textarea> 
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


<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/roomtypes/index.blade.php ENDPATH**/ ?>