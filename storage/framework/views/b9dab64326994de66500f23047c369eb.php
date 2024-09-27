<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img class="img-fluid for-light"
                    src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="">
                <img class="img-fluid for-dark"
                    src="<?php echo e(asset('assets/images/logo-dark.png')); ?>" alt="">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img class="img-fluid"
                    src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" alt="">
            </a>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <img class="img-fluid" 
                                src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>

                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6></h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='dashboard' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('dashboard')); ?>">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='bookings.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('bookings.index')); ?>">
                            <i data-feather="pocket"></i>
                            <span>Bookings</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" 
                            href="#">
                            <i data-feather="pocket"></i>
                            <span>Reservations</span>
                        </a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='guests.index' ? 'active' : ''); ?>" href="<?php echo e(route('guests.index')); ?>">
                            <svg class="stroke-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-user')); ?>"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#fill-user')); ?>"></use>
                            </svg><span>Guests</span></a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('statistics')): ?>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='loyalty' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('loyalty')); ?>">
                            <i data-feather="pie-chart"></i> 
                            <span>Customer Loyalty </span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='rooms.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('rooms.index')); ?>">
                            <i data-feather="home"></i>
                            <span>Rooms</span></a>
                    </li>
 
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='roomtypes.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('roomtypes.index')); ?>">
                            <i data-feather="command"></i>
                            <span>Room Types</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='services.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('services.index')); ?>">
                            <i data-feather="wifi"></i>
                            <span>Services</span>
                        </a>
                    </li>

                    

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employees')): ?>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='employees.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('employees.index')); ?>">
                            <i data-feather="users"> </i>
                            <span>Employees</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='users.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('users.index')); ?>">
                            <i data-feather="users"></i>
                            <span>Users</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='payroll' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('payroll')); ?>">
                            <i data-feather="credit-card"></i>
                            <span>Payroll</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='activity' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('activity')); ?>">
                            <i data-feather="activity"></i>
                            <span>Activity</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='payments.index' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('payments.index')); ?>">
                            <i data-feather="credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav <?php echo e(Route::currentRouteName()=='account' ? 'active' : ''); ?>" 
                            href="<?php echo e(route('account')); ?>">
                            <i data-feather="user"></i>
                            <span>Account</span>
                        </a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings')): ?>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" 
                            href="<?php echo e(route('settings')); ?>">
                            <i data-feather="settings"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div><?php /**PATH /Users/dan/Herd/protelier/resources/views/layouts/simple/sidebar.blade.php ENDPATH**/ ?>