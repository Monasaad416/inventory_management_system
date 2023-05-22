<!-- main-sidebar -->
	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="<?php echo e(url('/' . $page='index')); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/logo.png')); ?>" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="<?php echo e(url('/' . $page='index')); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/logo-white.png')); ?>" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="<?php echo e(url('/' . $page='index')); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/favicon.png')); ?>" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="<?php echo e(url('/' . $page='index')); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/favicon-white.png')); ?>" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="<?php echo e(URL::asset('assets/img/faces/user.png')); ?>"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<?php if(Auth::check()): ?>
							<h4 class="font-weight-semibold mt-3 mb-0"><?php echo e(Auth::user()->name); ?></h4>
							<span class="mb-0 text-muted"><?php echo e(Auth::user()->email); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
	
				<ul class="side-menu">
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
						<li class="side-item side-item-category">لوحة التحكم</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">الرئيسية</span></a>
						</li>
			        <?php endif; ?>
					
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('supplier')): ?>
						<li class="side-item side-item-category">لوحة التحكم</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">الرئيسية</span></a>
						</li>
			        <?php endif; ?>

							
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('founder')): ?>
						<li class="side-item side-item-category">لوحة التحكم</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">الرئيسية</span></a>
						</li>
			        <?php endif; ?>

					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shareholder')): ?>
						<li class="side-item side-item-category">لوحة التحكم</li>
						<li class="slide">
							<a class="side-menu__item" href="<?php echo e(route('dashboard')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">الرئيسية</span></a>
						</li>
			        <?php endif; ?>


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_list')): ?>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">المهام</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="<?php echo e(route('roles.index')); ?>">قائمة المهام</a></li>
								<li><a class="slide-item" href="<?php echo e(route('roles.create')); ?>">إضافة مهمة</a></li>
							</ul>
						</li>
				    <?php endif; ?>		
						
				


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('financial' )): ?>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg><span class="side-menu__label">المالية</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('store_payment_voucher')): ?>
								<li><a class="slide-item" href="<?php echo e(route('stores.index')); ?>"> سندات صرف المخازن </a></li>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('supplier_payment_voucher')): ?>
                            	<li><a class="slide-item" href="<?php echo e(route('suppliers_expenses.index')); ?>">  سندات صرف الموردين   </a></li>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('total_voucher')): ?>
                            <li><a class="slide-item" href="<?php echo e(route('outcome.livewire')); ?>">إجمالي سندات الصرف </a></li>
							<?php endif; ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_receipt_voucher')): ?>
                            <li><a class="slide-item" href="<?php echo e(route('income.livewire')); ?>">سندات قبض العملاء</a></li>
							<?php endif; ?>
                            <li><a class="slide-item" href="<?php echo e(route('financial.livewire')); ?>">المراجعة</a></li>

						</ul>
					</li>
					<?php endif; ?>
				


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_list')): ?>
				    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg><span class="side-menu__label"> الموردين</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            <li><a class="slide-item" href="<?php echo e(route('suppliers.index')); ?>">قائمة الموردين</a></li>
							<li><a class="slide-item" href="<?php echo e(route('suppliers.create')); ?>">إضافة مورد</a></li>
							<li><a class="slide-item" href="<?php echo e(route('suppliers-invoices.index')); ?>">قائمة الفواتير </a></li>
                            <li><a class="slide-item" href="<?php echo e(route('suppliers-invoices.create')); ?>"> إضافة فاتورة </a></li>
							
						</ul>
					</li>
					<?php endif; ?>

				    
				    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_list')): ?>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">العملاء</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?php echo e(route('clients.index')); ?>">قائمة العملاء</a></li>
							<li><a class="slide-item" href="<?php echo e(route('clients.create')); ?>">إضافة عميل</a></li>
                            <li><a class="slide-item" href="<?php echo e(route('clients-invoices.index')); ?>">قائمة الفواتير </a></li>
                            <li><a class="slide-item" href="<?php echo e(route('clients-invoices.create')); ?>"> إضافة فاتورة </a></li>
							
                        </ul>
					</li>
					<?php endif; ?>


					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('founders_list')): ?>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24" ><g><rect fill="none"/></g><g><g/><g><path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z"/><path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3"/></g><g><path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z"/><path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z"/><path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z"/></g></g></svg><span class="side-menu__label">المؤسسين </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
						    <li><a class="slide-item" href="<?php echo e(route('founders.index')); ?>">قائمة المؤسسين</a></li>
							<li><a class="slide-item" href="<?php echo e(route('founders.create')); ?>">إضافة مؤسس</a></li>
                            <li><a class="slide-item" href="<?php echo e(route('founders_accounts.index')); ?>">المعاملات المالية </a></li>
						</ul>
					</li>
					<?php endif; ?>


					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('shareholders_list')): ?>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24" ><g><rect fill="none"/></g><g><g/><g><path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z"/><path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3"/></g><g><path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z"/><path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z"/><path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z"/></g></g></svg><span class="side-menu__label">المساهمين </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
						    <li><a class="slide-item" href="<?php echo e(route('shareholders.index')); ?>">قائمة المساهمين</a></li>
							<li><a class="slide-item" href="<?php echo e(route('shareholders.create')); ?>">إضافة مساهم</a></li>
                            <li><a class="slide-item" href="<?php echo e(route('shareholders_accounts.index')); ?>">المعاملات المالية </a></li>
						</ul>
					</li>
					<?php endif; ?>





					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('section_list')): ?>
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/><circle cx="6.5" cy="11.5" r="1.5"/><circle cx="9.5" cy="7.5" r="1.5"/><circle cx="14.5" cy="7.5" r="1.5"/><circle cx="17.5" cy="11.5" r="1.5"/></svg><span class="side-menu__label">الأقسام</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?php echo e(route('sections.index')); ?>">قائمة الأقسام</a></li>
							<li><a class="slide-item" href="<?php echo e(route('sections.create')); ?>">إضافة قسم</a></li>
						</ul>
					</li>
					<?php endif; ?>


					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products_list')): ?>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="<?php echo e(url('/' . $page='#')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">المنتجات</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?php echo e(route('products.index')); ?>">قائمة المنتجات</a></li>
							<li><a class="slide-item" href="<?php echo e(route('products.create')); ?>">إضافة منتج</a></li>
						</ul>
					</li>
					<?php endif; ?>


                    <li class="slide">
						<a class="side-menu__item" href="<?php echo e(route('calculator')); ?>"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">حاسبة الكميات</span></a>
					</li>

                    <li class="slide">
						<a class="side-menu__item" href="<?php echo e(route('profile.edit', auth()->user()->id)); ?>"><img class="ml-2" src =<?php echo e(asset('assets/img/user.png')); ?> width="20px">الملف الشخصي</span></a>
					</li>


                    <li class="slide">
						<a class="side-menu__item" href="<?php echo e(route('logout')); ?>"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<svg style="color:#8992a5;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg><span class="side-menu__label">تسجيل خروج </span>
						</a>
					</li>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>










					
					



				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
<?php /**PATH C:\laragon\www\store\resources\views/layout/main-sidebar.blade.php ENDPATH**/ ?>