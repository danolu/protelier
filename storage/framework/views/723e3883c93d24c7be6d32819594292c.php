
<?php $__env->startSection('title', 'Bookings'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatable-extension.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Bookings</li>
<li class="breadcrumb-item active">All</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h5>Bookings</h5>
					<a class="btn btn-primary text-left" href="<?php echo e(route('bookings.create')); ?>">+ Booking</a>
				</div>

				<div class="card-body">
					<div class="dt-ext table-responsive">
						<table class="display" id="export-button">
							<thead>
								<tr>
									<th>#</th>
									<th>Booking Number</th>
									<th>Room(s)</th>
									<th>Guest</th>
									<th>CheckIn</th>
									<th>CheckOut</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e(++$k); ?></td>
									<td><?php echo e($booking->booking_id); ?></td>
									<td>
										<?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php echo e($booking->rooms[$i]->room_type->name.'-'.$booking->rooms[$i]->number); ?><br> 
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</td>
									<td><?php echo e($booking->guest->first_name.' '.$booking->guest->last_name); ?></td>
									<td><?php echo e(date("d-m-y", strtotime($booking->checkin))); ?></td>
									<td><?php echo e(date("d-m-y", strtotime($booking->checkout))); ?></td>
									<?php if($booking->status==0): ?>
									<td class="text-danger">Cancelled</td>
									<td><a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="btn btn-info btn-xs">View</a></td>
									<?php elseif($booking->status==1): ?>
									<td class="text-warning">Awaiting Checkin</td>
									<td>
										<a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="btn btn-info btn-xs">View</a>
										<a href="<?php echo e(route('bookings.edit', $booking->id)); ?>" class="btn btn-secondary btn-xs">Edit</a>
										<a href="<?php echo e(route('checkin', $booking->id)); ?>" class="btn btn-success btn-xs">Check in</a>
										<a href="#" data-bs-toggle="modal" data-bs-target="#cancel<?php echo e($booking->id); ?>" class="btn btn-danger btn-xs">Cancel</a>
									</td>
									<?php elseif($booking->status==2): ?>
									<td class="text-success">Checked In</td>
									<td>
										<a class="btn btn-xs btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#checkout<?php echo e($booking->id); ?>">Check out</a>
										<a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="btn btn-xs btn-info">View</a>
										<a href="<?php echo e(route('bookings.edit', $booking->id)); ?>" class="btn btn-secondary btn-xs">Edit</a>
										<a href="#" data-bs-toggle="modal" data-bs-target="#cancel<?php echo e($booking->id); ?>" class="btn btn-xs btn-success">Cancel</a>
									</td>
									<?php elseif($booking->status==3): ?>
									<td>Checked Out</td>
									<td><a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="btn btn-xs btn-info">View</a></td>
									<?php endif; ?>
								</tr>
								<div class="modal fade" id="checkout<?php echo e($booking->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					               <div class="modal-dialog" role="document">
					                  <div class="modal-content">
					                     <div class="modal-header">
					                        <h5 class="modal-title" id="exampleModalLabel2">Checkout</h5>
					                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					                     </div>
					                     <form method="POST" action="<?php echo e(route('checkout', $booking->id)); ?>">
					                      <?php echo csrf_field(); ?>
					                        <div class="modal-body">
					                           <div class="mb-3">
					                              <label class="col-form-label">Property Damage Cost:</label>
					                              <input class="form-control" type="number" name="property_damage_cost">
					                           </div>
					                           <div class="mb-3">
					                              <label class="col-form-label">Note:</label>
					                              <textarea class="form-control" name="note"><?php echo e($booking->note); ?></textarea>
					                           </div>
					                        </div>
					                        <div class="modal-footer">
					                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					                           <button class="btn btn-primary" type="submit">Checkout</button>
					                        </div>
					                     </form>
					                  </div>
					               </div>
					            </div>
					            <div class="modal fade" id="cancel<?php echo e($booking->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					               <div class="modal-dialog" role="document">
					                  <div class="modal-content">
					                     <div class="modal-header">
					                        <h5 class="modal-title" id="exampleModalLabel2">Checkout</h5>
					                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					                     </div>
					                     <form method="POST" action="<?php echo e(route('bookings.cancel', $booking->id)); ?>">
					                      <?php echo csrf_field(); ?>
					                        <div class="modal-footer">
					                           <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					                           <button class="btn btn-primary" type="submit">Cancel</button>
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
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatable-extension/custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/bookings/index.blade.php ENDPATH**/ ?>