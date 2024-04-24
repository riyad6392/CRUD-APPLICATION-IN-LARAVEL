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
      <a class="nav-link text-light" href="Create">Category</a>
    </li>
  </ul>

</nav>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
          <strong><?php echo e($message); ?></strong>
        </div>
    <?php endif; ?>

    <div class="container">
    		<table class="table table-hover mt-2">
               <thead>
              	  <tr>
                       <th>Sno</th>
                       <th>Name</th>
                      <!--  <th>Description</th>
                       <th>Category</th>
                       <th>Image</th> -->
                       <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               	  <?php $__currentLoopData = $categoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                       <td><?php echo e($loop->index+1); ?></td>
                       <td><?php echo e($category->name); ?></td>
                       <td>
                       	<a href="<?php echo e($category->id); ?>/edit" class="btn btn-dark btn-sm">Edit</a>
                       	<a href="<?php echo e($category->id); ?>/delete" class="btn btn-danger btn-sm">Delete</a>

                       </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>


    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\LaravelCRUD\resources\views/categories/index.blade.php ENDPATH**/ ?>