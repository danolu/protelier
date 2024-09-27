<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
    <title>Protelier</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <?php echo $__env->make('layouts.simple.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>
  </head>
  
  <body <?php if(Route::current()->getName() == 'index'): ?> onload="startTime()" <?php endif; ?>>
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <?php echo $__env->make('layouts.simple.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="page-body-wrapper">
        <?php echo $__env->make('layouts.simple.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <?php echo $__env->yieldContent('breadcrumb-title'); ?>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">                    <svg class="stroke-icon">
                          <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>">
                          </use>
                        </svg>
                        </a>
                    </li>
                    <?php echo $__env->yieldContent('breadcrumb-items'); ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <?php echo $__env->yieldContent('content'); ?>
        </div>
        <?php echo $__env->make('layouts.simple.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
      </div>
    </div>
    <?php echo $__env->make('layouts.simple.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
  </body>
</html><?php /**PATH /Users/dan/Herd/protelier/resources/views/layouts/simple/master.blade.php ENDPATH**/ ?>