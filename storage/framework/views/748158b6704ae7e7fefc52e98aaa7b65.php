
<?php $__env->startSection('title', 'Create Booking'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jquery.flexdatalist.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/select2.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>New Booking</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item">Bookings</li>
<li class="breadcrumb-item active">Create</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h5>Create Booking</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<form class="theme-form" action="<?php echo e(route('bookings.store')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<section>
							<?php $today = date('Y-m-d') ?>
							<div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Check In</label>
								<div class="date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" min="<?php echo e($today); ?>" type="date" id="checkin" value="<?php echo e(old('checkin')); ?>" name="checkin" required="">
								</div>
							</div>

							<?php 
			                  $nextday = date('Y-m-d', strtotime($today))." +1 day";
			                  $nextday = date('Y-m-d', strtotime($nextday));
			                ?>
							<div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Check Out</label>
								<div class="date col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control datetimepicker-input digits" type="date" min="<?php echo e($nextday); ?>" id="checkout" name="checkout" value="<?php echo e(old('checkout')); ?>" required="">
								</div>
							</div>

							<div class="mb-3 g-3 row duration" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Duration</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="input-group">
										<input class="form-control" type="number" id="duration" name="duration" readonly value="<?php echo e(old('duration')); ?>">
					                    <span class="input-group-text">Nights</span>
									</div>
								</div>
							</div>

		                    <div class="mb-3 g-3 row">
								<label class="col-sm-3 col-form-label text-end">Room Type</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<select class="form-control digits" id="roomtype_id" required="">
									<option hidden selected disabled>Select room type</option>
									<?php $__currentLoopData = $roomtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($roomtype->id); ?>"><?php echo e($roomtype->name); ?></option>	
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							
							<div class="mb-3 g-3 row" id="check_availability" style="display: none;">
								<label class="col-sm-3 col-form-label text-end"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="input-group">
										<button class="btn btn-outline-primary" id="btn-check" type="button" data-container="body" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="You haven't picked dates.">Check Availability</button>
									</div>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Available Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<select class="available_rooms col-12" id="available_rooms" multiple="multiple">
									</select>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="confirm_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end"></label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<button class="btn btn-outline-primary" id="btn-confirm" type="button" data-container="body" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Rooms haven't been chosen">Confirm Room(s)</button>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="confirmed_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Room(s)</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control confirmed_rooms" type="text" name='room_numbers' required readonly><button class="btn btn-xs btn-info" id="reset_rooms">edit</button>
								</div>
							</div>

							<div class="mb-3 g-3 row" id="number_of_rooms" style="display: none;">
								<label class="col-sm-3 col-form-label text-end">Number of Rooms</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<input class="form-control" id="no_of_rooms" readonly type="number" name="no_of_rooms">
								</div>
							</div>

							<div class="mb-3 g-3 row adults" style="display: none;">
				                <label class="col-sm-3 col-form-label text-end">Adults</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8">
				                  <input class="touchspin" type="number" min="1" name="adults" id="adults" required="" value="<?php echo e(old('adults', 1)); ?>">
				                </div>
				            </div>

				            <div class="mb-3 g-3 row children" style="display: none;">
				                <label class="col-sm-3 col-form-label text-end">Children</label>
				                <div class="col-xl-5 col-sm-7 col-lg-8">
				                  <input class="touchspin" type="number" min="0" id="children" name="children" required="" value="<?php echo e(old('children', 0)); ?>">
				                </div>
				            </div>
						</section>

						<section id="payment_info" style="display: none;">
				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Cost </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                 	<input type="number" class="form-control" name="cost" id="cost" value="<?php echo e(old('cost')); ?>" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Caution Fee (Refundable) </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="caution" id="caution" value="<?php echo e(old('caution')); ?>" readonly>
				                </div>
				              </div>
				            </div>

				            <div class="media row">
								<label class="col-form-label col-md-3 text-end">Caution Paid?</label>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="media-body icon-state">
										<label class="switch">
										<input value="1" name="caution_status" type="checkbox" <?php echo e((old('caution_status') == '1' ) ? 'checked' : ''); ?>><span class="switch-state"></span>
										</label>
									</div>
								</div>
							</div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Discount </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="discount" id="discount" value="<?php echo e(old('discount')); ?>" min="0" >
				                </div>
				                <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                  <div class="error-message text-danger pl-1 mt-1">
				                    <small><?php echo e($message); ?></small>
				                  </div>
				                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				              </div>
				            </div>

				            <div class="row mb-4">
				              <label class="col-form-label col-md-3 text-end">Extra Charge </sup></label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <div class="input-group">
				                    <span class="input-group-text">N</span>
				                  	<input type="number" class="form-control" name="extra_charge" id="extra_charge" value="<?php echo e(old('extra_charge')); ?>" min="0">
				                </div>
				              </div>
				            </div>
				        </section>  

						<section id="guest-info" style="display: none;">
							<div class="mb-3 g-3 row">
								<div class="col-sm-3 col-form-label text-end">
									<h6>Guest </sup></sup></h6>
								</div>
								<div class="col-xl-5 col-sm-7 col-lg-8">
									<div class="mb-3 m-t-5 m-checkbox-inline mb-0 custom-radio-ml">
										<div class="radio radio-secondary">
											<input id="new" value="new" type="radio" name="guesttype" <?php echo e((old('guesttype') == 'new' ) ? 'checked' : ''); ?>>
											<label class="mb-0" for="new">New</label>
										</div>
										<div class="radio radio-secondary">
											<input id="returning" value="returning" type="radio" name="guesttype" <?php echo e((old('guesttype') == 'returning' ) ? 'checked' : ''); ?>>
											<label class="mb-0" for="returning">Returning</label>
										</div>
									</div>
								</div>
							</div>
							<div id="new_guest" style="display: none;">
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Salutation*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<select class="form-control" name="salutation">
		                              <option hidden selected disabled>Select Salutation</option>
		                              <option value="Mr">Mr</option>
		                              <option value="Mrs">Mrs</option>
		                              <option value="Miss">Miss</option>
		                              <option value="Dr">Dr</option>
		                              <option value="Engr.">Engr.</option>
		                              <option value="Barr.">Barr.</option>
	                           	  </select>
	                              </div>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">First name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="first_name">
	                              </div>
	                              <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Last name*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="last_name">
	                              </div>
	                              <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Email</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="email" name="email">
	                              </div>
	                              <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Phone*</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="phone">
	                              </div>
	                               <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Address</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="text" name="address">
	                              </div>
	                               <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">NIN / Passport Number</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="number" name="nin">
	                              </div>
	                              	<?php $__errorArgs = ['nin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Emergency Contact</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<input class="form-control" type="tel" name="emergency_contact">
	                              </div>
	                              	<?php $__errorArgs = ['emergency_contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
	                           <div class="mb-3 g-3 row">
	                              <label class="col-sm-3 col-form-label text-end">Guest Note/Preference</label>
	                              <div class="col-xl-5 col-sm-7 col-lg-8">
	                              	<textarea class="form-control" name="guest_note"></textarea>
	                              </div>
	                                <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
				                      <div class="error-message text-danger pl-1 mt-1">
				                        <small><?php echo e($message); ?></small>
				                      </div>
				                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	                           </div>
							</div>

							<div id="returning_guest" style="display: none;">
								<div class="mb-3 g-3 row">
				                    <label class="col-sm-3 col-form-label text-end">Guest </sup></label>
				                    <div class="col-xl-5 col-sm-7 col-lg-8">
				                    	<input type="text" placeholder="Search Guest Name" class="form-control flexdatalist" data-min-length='1' list='guests' name="guest">
					                    <datalist id="guests">
					                      <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					                        <option value="<?php echo e($guest->id); ?>" <?php if(old('guest') == $guest->id): ?> selected <?php endif; ?>> <?php echo e($guest->first_name.' '.$guest->last_name); ?></option>
					                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					                    </datalist>
					                    <input type="hidden" name="guest_id" id="guest_id">
					                    <div class="guest_info" style="display: none;">
					                  		<p class="mt-2">Email :<span id="g-email"></span></p>
					                  		<p class="mt-2">Phone :<span id="g-phone"></span></p>
					                  		<p class="mt-2">Address :<span id="g-address"></span></p>
					                  		<p class="mt-2">Note :<span id="g-note"></span></p>
					                  	</div>
				                    </div>
			                  	</div>
							</div>
						</section>

						<section id="payment-info2" style="display: none;">
							<div class="mb-3 g-3 row">
							  <label class="col-sm-3 col-form-label text-end">Payment Status* </sup></label>
							  <div class="col-xl-5 col-sm-7 col-lg-8">
								<select class="form-control" id="payment_status" name="payment_status" required="">
								  <option disabled hidden <?php if(old('payment_status') == ''): ?> selected <?php endif; ?>>Select Payment Status</option>
								  <option value="1" <?php if(old('payment_status') == '1'): ?> selected <?php endif; ?> >Full Payment</option>
								  <option value="2" <?php if(old('payment_status') == '2'): ?> selected <?php endif; ?> >Deposit</option>
								  <option value="0" <?php if(old('payment_status') == '0'): ?> selected <?php endif; ?> >Credit</option>
								</select>
								<?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								  <div class="error-message text-danger pl-1 mt-1">
									<small><?php echo e($message); ?></small>
								  </div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							  </div>
							</div>
  
							<div class="row mb-4 deposit" style="display: none;">
							  <label class="col-form-label col-md-3 text-end">Deposit</label>
							  <div class="col-xl-5 col-sm-7 col-lg-8">
								<div class="input-group">
									<span class="input-group-text">N</span>
									  <input type="number" class="form-control" name="deposit" id="deposit" value="<?php echo e(old('deposit')); ?>">
								</div>
								<?php $__errorArgs = ['deposit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								  <div class="error-message text-danger pl-1 mt-1">
									<small><?php echo e($message); ?></small>
								  </div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							  </div>
							</div>
  
							<div class="mb-3 g-3 row" id="payment-method" style="display: none;">
							  <label class="col-sm-3 col-form-label text-end">Payment Method*</label>
							  <div class="col-xl-5 col-sm-7 col-lg-8">
								<select class="form-control" id="payment_methods" name="payment_method" required>
								  <option disabled hidden selected>Select Payment Method</option>
								  <option value="Transfer" <?php if(old('payment_method') == 'Transfer'): ?> selected <?php endif; ?>>Transfer</option>
								  <option value="POS" <?php if(old('payment_method') == 'POS'): ?> selected <?php endif; ?>>POS</option>
								  <option value="Cash" <?php if(old('payment_method') == 'Cash'): ?> selected <?php endif; ?>>Cash</option>
								</select>
								<?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								  <div class="error-message text-danger pl-1 mt-1">
									<small><?php echo e($message); ?></small>
								  </div>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							  </div>
							</div>
						  </section>

						<section id="book" style="display: none;">
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Purpose</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="purpose" id="purpose"><?php echo e(old('purpose')); ?>

				              </div>
				            </div>
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Car Number</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <input class="form-control" type="text" name="car_number" id="car_number"><?php echo e(old('car_number')); ?>

				              </div>
				            </div>
				            <div class="mb-3 g-3 row">
				              <label class="col-sm-3 col-form-label text-end" for="note">Booking Note</label>
				              <div class="col-xl-5 col-sm-7 col-lg-8">
				                <textarea class="form-control" rows="3" name="note" id="note"><?php echo e(old('note')); ?></textarea>
				              </div>
				            </div>
				            <hr>

					        <div class="mb-3 g-3 row mt-2">
					            <div class="col-md-12">
					              <button type="submit" class="btn btn-block btn-outline-primary px-5">CREATE BOOKING</button>
					            </div>
					        </div>
					    </section>

						
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>

  <div class="modal fade" id="no_rooms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary font-weight-medium" id="exampleModalLabel">No room found</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h6 class="font-weight-medium">No rooms matching queries were found. Change room type or dates and try again.</h6>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/js/touchspin/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/touchspin/touchspin.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/touchspin/input-groups.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.flexdatalist.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
<script>
	//Date Validation
	$(function () {
	$('#checkin').change(function() {
		$('#checkout').val("")
		$('#duration').val("")
		$('.duration').hide('600')
		$('#check_availability').hide('600')
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
        startdate = new Date($(this).val());
        startdate.setDate(startdate.getDate() + 1);
        var mindate = startdate.toISOString().substr(0,10);
        $('#checkout').attr('min', mindate);
        $('#btn-check').tooltip('enable')
      });

	$('#checkout').change(function() {
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
        startdate = new Date($('#checkin').val());
        checkout = new Date($(this).val());
        diff = new Date(checkout - startdate);
        days  = diff/1000/60/60/24;
        if (days > 0) {
          $('#duration').val(days);
        }
        $('.duration').show('600')
        if ($('#roomtype_id').val()) {
           $('#check_availability').show('600')	
        }
        $('#btn-check').tooltip('disable')
      });

	$('#roomtype_id').change(function() {
		$('#rooms').hide('600')
	    $('#confirm_rooms').hide('600')
	    $('.confirmed_rooms').val("")
	    $('#confirmed_rooms').hide('600')
	    $('#no_of_rooms').val("")
	    $('#number_of_rooms').hide('600')
	    $('#payment_info').hide('600')
	    $('.adults').hide('600')
        $('.children').hide('600')
	    if ($('#checkin').val() && $('#checkout').val()) {
	       $('#check_availability').show('600')
	    }
      });


	$(".available_rooms").select2({
        placeholder: "Select Rooms"
    });

    $('form').on('click', '#btn-check', function() {
    	$('#available_rooms').empty()
    	$('#rooms').hide('600')
        $('#confirm_rooms').hide('600')
      let checkin = $('#checkin').val();
      let checkout = $('#checkout').val();
      let roomtype_id = $('#roomtype_id').val();
      if (checkin && checkout && roomtype_id) {
        let url = '<?php echo e(route('getavailablerooms', [":checkin", ":checkout", ":roomtype_id"])); ?>'
        url = url.replace(':checkin', checkin)
        url = url.replace(':checkout', checkout)
        url = url.replace(':roomtype_id', roomtype_id)
        $.ajax({
          type:'GET',
          url: url,
          success:function(data){
          	if (data) {
          		rooms = data.rooms
                let html = "";
                $.each(rooms, function(i, v) {
                  html += `
                  <option value="${v.number}">${v.number}</option> 
                  `;
                });
                $('#available_rooms').append(html);
                $('#rooms').show('400')
                $('#check_availability').hide('600')
                $('#confirm_rooms').show('400')
          	} else {
                $('#available_rooms').append(html);
                $('#rooms').hide('600');
                $('#no_rooms').modal('show')
          	}
          },
          error:function(e) {
            console.log(e)
          }
        });
        $('#btn-confirm').tooltip('disable')
      } else {
        $('#btn-check').tooltip('enable')
      }
    });


    $('form').on('click', '#reset_rooms', function() {
    	$('#rooms').show('600')
        $('#confirm_rooms').show('600')
        $('#check_availability').hide('600')
        $('#number_of_rooms').hide('600')
        $('#payment_info').hide('600')
        $('#confirmed_rooms').hide('600')
        $('.adults').hide('600')
        $('.children').hide('600')
    });

    $('form').on('click', '#btn-confirm', function() {
      let duration = $('#duration').val();
      if (duration) {
      	let rooms = $('#available_rooms').val();
        let roomtype_id = $("#roomtype_id").val();
        let no_of_rooms = rooms.length;
        if (roomtype_id && no_of_rooms) {
         let url = '<?php echo e(route('gettotalcost', [":roomtype_id", ":no_of_rooms", ":duration"])); ?>'
         url = url.replace(':roomtype_id', roomtype_id)
         url = url.replace(':no_of_rooms', no_of_rooms)
         url = url.replace(':duration', duration)
          $.ajax({
            type:'GET',
            url: url,
            success:function(data){
            	console.log(data)
              $('#cost').val(data.cost);
              $('#caution').val(data.caution);
              $('#discount').attr('max', data.cost);
              $('#adults').attr('max', data.adults);
              $('#children').attr('max', data.children);
              $('#deposit').attr('max', data.cost - 1);
            },
            error:function(e) {
            console.log(e)
          	}
          });
          $('#no_of_rooms').val(no_of_rooms)
          $('#confirm_rooms').hide('600')
          $('#number_of_rooms').show('600')
          $('#payment_info').show('600')
		  $('#guest-info').show('600')
          $('.confirmed_rooms').val(rooms)
          $('#confirmed_rooms').show('600')
          $('#rooms').hide('600')
          $('.adults').show('600')
          $('.children').show('600')
        } else {
        	$('#btn-confirm').tooltip('enable')
      	   } 
      }  
    });

    $('#adults').change(function() {
    	if ($(this).val()>$(this).attr('max')) {
    		alert('Adult capacity for selected room(s) exceeded')
    		$(this).val($(this).attr('max'))
    	}
      });

    $('#children').change(function() {
    	if ($(this).val()>$(this).attr('max')) {
    		alert('Children capacity for selected room(s) exceeded')
    		$(this).val($(this).attr('max'))
    	}
      });


	$('input[type=radio][name=guesttype]').change(function() {
	    if (this.value == 'returning') {
	      $('#new_guest').hide('600');
	      $('#returning_guest').show('400');
	    } else {
	      $('#returning_guest').hide('600');
	      $('#new_guest').show('400');
		  $('#payment-info2').show('600')
	      $('#book').show('600')
	    }
	  });

	$('.flexdatalist').flexdatalist({
	    minLength: 1,
	    noResultsText: 'No Guest found for "{keyword}"'
	  });

  	$('input.flexdatalist').on('select:flexdatalist', function(event, set, options) {
      let guestid = set.value;
      let url = '<?php echo e(route('getguestdata', ":guestid")); ?>'
      url = url.replace(':guestid', guestid)

      $.ajax({
        type:'GET',
        url: url,
        success:function(data){
	    	if (data.email) {
	    		$('#g-email').text(data.email)		
	    	} else {
	    		$('#g-email').text('Guest email not in records')
	    	}
	    	if (data.phone) {
	    		$('#g-phone').text(data.phone)		
	    	} else {
	    		$('#g-phone').text('Guest phone number not in records')
	    	}
	    	if (data.note) {
	    		$('#g-note').text(data.note)		
	    	} else {
	    		$('#g-note').text('No available note for guest')
	    	}
	    	if (data.address) {
	    		$('#g-address').text(data.address)		
	    	} else {
	    		$('#g-address').text('Guest address not in records')
	    	}
			$('#guest_id').val(data.guest_id)
			$('#g-loyalty_points').text(data.loyalty_points)
			if (data.loyalty_points >= $('#cost').val()) {
				$('#payment_methods').append($('<option>', {
					value: 'loyalty_points',
					text: 'Loyalty Points'
				}));
			} else if ($("#payment_methods option[value='loyalty_points']")) {
				$("#payment_methods option[value='loyalty_points']").remove();
			}
        },
        error:function(e) {
          console.log(e)
        }
      });
      $('.guest_info').show('500')
      $('#payment-info2').show('600')
	      $('#book').show('600')
    });

	$('#payment_status').change(function() {
        if ($(this).val() == 1) {
          $('.deposit').hide('600')
          $('#payment-method').show('600')
          $('#payment-method').prop('required', true)
        } else if ($(this).val() == 2) {
          $('.deposit').show('600')	
          $('#payment-method').show('600')
          $('#payment-method').prop('required', true)
        } else if ($(this).val() == 0) {
        	$('#payment-method').prop('required', false)
        	$('#payment-method').hide('600')
        	$('.deposit').hide('600')
        }
      });

    $('#payment_method').change(function() {
          $('#book').show('600')
      });

    })  // end of document ready function 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/dan/Herd/protelier/resources/views/bookings/create.blade.php ENDPATH**/ ?>