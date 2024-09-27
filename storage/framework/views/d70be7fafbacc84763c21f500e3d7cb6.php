
<?php $__env->startSection('title', 'Rooms'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Rooms</li>
<li class="breadcrumb-item active">All</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
   <div class="row">
      <!-- Individual column searching (text inputs) Starts-->
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <h5>Rooms</h5>
               <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#createroom">Create New Room</a>
            </div>
            <div class="modal fade" id="createroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create Room</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="<?php echo e(route('rooms.store')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                        <div class="modal-body">
                           <div class="mb-3">
                              <label class="col-form-label">Room Number*:</label>
                              <input class="form-control" type="number" name="number" placeholder="Room number must be unique" required>
                           </div>
                           <div class="mb-3">
                              <label class="col-form-label">Room Type*</label>
                              <div class="input-group">
                                 <select class="form-control" name='room_type_id' required="">
                                    <option selected disabled hidden> Select room type</option>
                                 <?php $__currentLoopData = $roomtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($roomtype->id); ?>"><?php echo e($roomtype->name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
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
            <div class="card-body">
               <div class="table-responsive product-table">
                  <table class="display" id="basic-1">
                     <thead>
                        <tr>
                           <th>Number</th>
                           <th>Type</th>
                           <th>Status</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td><?php echo e($room->number); ?></td>
                           <td><?php echo e($room->room_type->name); ?></td>
                           <?php if($room->status==0): ?>
                           <td class="font-danger">Unvailable</td>
                           <?php elseif($room->status==1): ?>
                           <td class="font-info">Available</td>
                           <?php elseif($room->status==2): ?>
                           <td class="font-warning">Booked</td>
                           <?php elseif($room->status==3): ?>
                           <td class="font-success">Checked In</td>
                           <?php endif; ?>
                           <td>
                              <?php if($room->status==0): ?>
                                 <a class="btn btn-success btn-xs" href="<?php echo e(route('rooms.activate', $room->id)); ?>">Activate</a>
                              <?php elseif($room->status==1): ?>
                                 <a class="btn btn-warning btn-xs" href="<?php echo e(route('rooms.deactivate', $room->id)); ?>">Deactivate</a>
                              <?php endif; ?>
                              <a class="btn btn-success btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#editroom<?php echo e($room->id); ?>">Edit</a>
                              <?php if($room->status==0||$room->status==1): ?>
                              <a class="btn btn-danger btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#deleteroom<?php echo e($room->id); ?>">Delete</a>
                              <?php endif; ?>
                           </td>
                        </tr>
                        <div class="modal fade" id="deleteroom<?php echo e($room->id); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteroom<?php echo e($room->id); ?>" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Deletion Confirmation</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure you want to delete this room?.</p>
                                 </div>
                                 <div class="modal-footer">
                                 <form action="<?php echo e(route('rooms.destroy', $room->id)); ?>" method="POST">
                                    <?php echo method_field('delete'); ?>
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Delete Room</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal fade" id="editroom<?php echo e($room->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Edit Room</h5>
                                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 </div>
                                 <form action="<?php echo e(route('rooms.update', $room->id)); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <?php echo method_field('patch'); ?>
                                    <div class="modal-body">
                                       <div class="mb-3">
                                          <label class="col-form-label">Number*:</label>
                                          <input class="form-control" type="number" name="number" value="<?php echo e($room->number); ?>" readonly="" required>
                                       </div>
                                       <div class="mb-3">
                                          <label class="col-form-label">Room Type*</label>
                                          <div class="input-group">
                                             <select class="form-control" name='room_type_id' required="">
                                             <?php $__currentLoopData = $roomtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <?php if($room->room_type->id==$roomtype->id): ?>
                                                <option value="<?php echo e($roomtype->id); ?>" selected=""><?php echo e($roomtype->name); ?></option>
                                             <?php else: ?>
                                                <option value="<?php echo e($roomtype->id); ?>"><?php echo e($roomtype->name); ?></option>
                                             <?php endif; ?>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
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
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/rooms/index.blade.php ENDPATH**/ ?>