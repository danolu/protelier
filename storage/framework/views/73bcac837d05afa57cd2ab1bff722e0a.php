<script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/icons/feather-icon/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/icons/feather-icon/feather-icon.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/scrollbar/simplebar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/scrollbar/custom.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/config.js')); ?>"></script>

<script id="menu" src="<?php echo e(asset('assets/js/sidebar-menu.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/slick/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/slick/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/header-slick.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>

<?php if(Route::current()->getName() != 'popover'): ?> 
	<script src="<?php echo e(asset('assets/js/tooltip-init.js')); ?>"></script>
<?php endif; ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(session('success')): ?>
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'success',
          title: '<?php echo e(session('success')); ?>'
        })
    </script>
    <?php endif; ?>

    <?php if(session('alert')): ?>
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
          
          Toast.fire({
            icon: 'error',
            title: '<?php echo e(session('alert')); ?>'
          })
    </script>
    <?php endif; ?>

    <?php if(session('message')): ?>
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 7000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
          
          Toast.fire({
            icon: 'success',
            title: '<?php echo e(session('message')); ?>'
          })
    </script>
    <?php endif; ?>

    
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>

<?php if(Route::currentRouteName() == 'index'): ?>
<script>
	new WOW().init();
</script>
<?php endif; ?>
<?php /**PATH /Users/dan/Herd/protelier/resources/views/layouts/simple/script.blade.php ENDPATH**/ ?>