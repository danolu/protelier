<div class="page-header">
  <div class="header-wrapper row m-0">
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper">
        <a href="<?php echo e(route('dashboard')); ?>">
          <img class="img-fluid" src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="">
        </a>
      </div>
      <div class="toggle-sidebar">
        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
      </div>
    </div>
    <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
      <div class="d-flex h-100">
        <a href="<?php echo e(route('bookings.create')); ?>" class="btn btn-success btn-md me-2"><i class="fa fa-plus"></i> Booking</a> 
        <a href="<?php echo e(route('rooms.available')); ?>" class="btn btn-secondary btn-md"><i class="fa fa-home"></i> Available Rooms</a> 
      </div>
    </div>
    <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
      <ul class="nav-menus">
        <li>
          <div class="mode">
            <svg>
              <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#moon')); ?>"></use>
            </svg>
          </div>
        </li>

        <li class="profile-nav onhover-dropdown pe-0 py-0">
          <div class="media profile-media">
            <img class="b-r-10" src="<?php echo e(asset('assets/images/user.png')); ?>" alt="" />
            <div class="media-body">
              <span><?php echo e($user->employee->first_name); ?></span>
              <p class="mb-0 font-roboto"><?php echo e($user->getRoleNames()->implode('')); ?> <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li>
              <a href="<?php echo e(route('account')); ?>"><i data-feather="user"></i><span>Account</span></a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings')): ?>
            <li>
              <a href="<?php echo e(route('settings')); ?>"><i data-feather="settings"></i><span>Settings</span></a>
            </li>
            <?php endif; ?>
            <li>
              <a href="<?php echo e(route('logout')); ?>"><i data-feather="log-out"> </i><span>Log Out</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div><?php /**PATH /Users/dan/Herd/protelier/resources/views/layouts/simple/header.blade.php ENDPATH**/ ?>