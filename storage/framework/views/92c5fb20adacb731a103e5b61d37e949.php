<!-- Title -->
<title> لوحة الادارة -  جميع الخصائص بالبرنامج </title>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Favicon -->
<link rel="icon" href="<?php echo e(URL::asset('assets/img/brand/favicon.png')); ?>" type="image/x-icon"/>
<!-- Icons css -->
<link href="<?php echo e(URL::asset('assets/css/icons.css')); ?>" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="<?php echo e(URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')); ?>" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="<?php echo e(URL::asset('assets/plugins/sidebar/sidebar.css')); ?>" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css-rtl/sidemenu.css')); ?>">
<?php echo $__env->yieldContent('css'); ?>
<!--- Style css -->
<link href="<?php echo e(URL::asset('assets/css-rtl/style.css')); ?>" rel="stylesheet">

<link href="<?php echo e(URL::asset('assets/wizard.css')); ?>" rel="stylesheet">
<!--- Dark-mode css -->
<link href="<?php echo e(URL::asset('assets/css-rtl/style-dark.css')); ?>" rel="stylesheet">
<!---Skinmodes css-->
<link href="<?php echo e(URL::asset('assets/css-rtl/skin-modes.css')); ?>" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<?php echo \Livewire\Livewire::styles(); ?>


<?php echo $__env->yieldPushContent('css'); ?>


<?php /**PATH C:\laragon\www\store\resources\views/layout/head.blade.php ENDPATH**/ ?>