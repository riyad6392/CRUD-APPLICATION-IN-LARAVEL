<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel CRUD</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>



<body>
	<nav class="navbar navbar-expand-sm bg-dark">
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-light" href="/">Products</a>
    </li>

     <li class="nav-item">
      <a class="nav-link text-light" href="categories/Create">CategoryCreate</a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-light" href="categories/index">CategoryList</a>
     </li>

    <li class="nav-item">
      <a class="nav-link text-light" href="brands/Create">BrandCreate</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light" href="brands/index">BrandList</a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-light" href="stocks/index">StockList</a>
    </li>



  </ul>

</nav>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
          <strong><?php echo e($message); ?></strong>
        </div>
    <?php endif; ?>

    <div class="container">
    	<div class="text-right">
    		<a href="products/Create" class="btn btn-dark mt-2">New Product</a>
            <a href="/profile" class="btn btn-dark mt-2">Profile</a>
            
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="btn btn-dark mt-2">
                <?php echo csrf_field(); ?>

                <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault();
                                    this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault();
                                    this.closest(\'form\').submit();']); ?>
                    <?php echo e(__('Log Out')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
            </form>
    	</div>
    		<table class="table table-hover mt-2">
               <thead>
              	  <tr>
                       <th>Sno</th>
                       <th>Name</th>
                       <th>Description</th>
                       <th>Price</th>
                       <th>CategoryName</th>
                       <th>BrandName</th>
                       <th>ModelName</th>
                       <th>Image</th>
                       <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               	  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                       <td><?php echo e($loop->index+1); ?></td>
                       <td><?php echo e($product->name); ?></td>
                       <td><?php echo e($product->description); ?></td>
                       <td><?php echo e($product->price); ?></td>
                       <td><?php echo e($product->category?->name); ?></td>
                       <td><?php echo e($product->brand?->name); ?></td>
                       

                       <td>
                             
                                <table class="table table-hover mt-2">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php if($product->id==$stock->product_id): ?>
                                                  <td><?php echo e($stock->name); ?></td>
                                                  <td><?php echo e($stock->quantity); ?></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                             
                        </td>





                       <td>
                       	<!-- <img src="storage/uploads/<?php echo e($product->image); ?>" class="rounded-circle" width="50" height="50" /> -->

                        <!-- <img src="storage/app/uploads/<?php echo e($product->image); ?>" class="rounded-circle" width="50" height="50" /> -->
                        <!-- <img src="<?php echo e(url('storage/' . $product->image)); ?>" class="rounded-circle" width="50" height="50" /> -->
                        <img src="<?php echo e($product->image); ?>" class="rounded-circle" width="50" height="50" />
                       </td>
                       <td>
                       	<a href="products/<?php echo e($product->id); ?>/edit" class="btn btn-dark btn-sm">Edit</a>

                       	<a href="products/<?php echo e($product->id); ?>/delete" class="btn btn-danger btn-sm">Delete</a>

                       </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\LaravelCRUD\resources\views/products/index.blade.php ENDPATH**/ ?>