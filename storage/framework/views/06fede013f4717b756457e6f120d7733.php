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
                <a class="nav-link text-light" href="/index">Products</a>
            </li>
        </ul>
    </nav>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-block">
            <strong><?php echo e($message); ?></strong>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <form method="POST" action="/products/store" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" />
                            <?php if($errors->has('name')): ?>
                                <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" row="4" name="description"><?php echo e(old('description')); ?></textarea>
                            <?php if($errors->has('description')): ?>
                                <span class="text-danger"><?php echo e($errors->first('description')); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <textarea class="form-control" row="4" name="price"><?php echo e(old('price')); ?></textarea>
                            <?php if($errors->has('price')): ?>
                                <span class="text-danger"><?php echo e($errors->first('price')); ?></span>
                            <?php endif; ?>
                        </div>

                        <h1>Category</h1>
                        <select name="category_id">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <h1>Brand</h1>
                        <select name="brand_id">
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                            <?php if($errors->has('image')): ?>
                                <span class="text-danger"><?php echo e($errors->first('image')); ?></span>
                            <?php endif; ?>
                        </div>

                        <h1>Stock</h1>

                       <!-- Dynamically added fields -->
                       <div id="dynamic-fields">
                        <div class="form-group dynamic-field">

                                <?php if(!empty(old('stock'))): ?>

                                    <?php $__currentLoopData = old('stock'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="stock[<?php echo e($key); ?>][name]" placeholder="Name" class="form-control mt-4" value="<?php echo e($stock['name']); ?>">
                                                <?php $__errorArgs = ["stock.$key.name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="stock[<?php echo e($key); ?>][quantity]" placeholder="Quantity" class="form-control mt-4" value="<?php echo e($stock['quantity']); ?>">
                                                <?php $__errorArgs = ["stock.$key.quantity"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            
                                            <?php if($key==0): ?>
                                            <div class="col">
                                                <button type="button" class="btn btn-primary mt-4" id="add-field">Add More</button>
                                            </div>
                                            <?php else: ?>
                                            <div class="col">
                                                <button type="button" class="btn btn-danger remove-field mt-4">Remove</button>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php else: ?>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="stock[0][name]" placeholder="Name" class="form-control" value="<?php echo e(old('stock.0.name')); ?>">
                                            <?php $__errorArgs = ['stock.0.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="stock[0][quantity]" placeholder="Quantity" class="form-control" value="<?php echo e(old('stock.0.quantity')); ?>">
                                            <?php $__errorArgs = ['stock.0.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary " id="add-field">Add More</button>
                                        </div>

                                    </div>
                                <?php endif; ?>

                                
                        </div>
                    </div>
                    
                    <!-- End of dynamically added fields -->

                    <button type="submit" class="btn btn-dark mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var i = 1;
        $('#add-field').click(function () {
            $('#dynamic-fields').append(`
                <div class="form-group dynamic-field">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="stock[${i}][name]" placeholder="Name" class="form-control" value="<?php echo e(old('stock${i}name')); ?>">
                             <?php $__errorArgs = ['stock${i}name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col">
                            <input type="text" name="stock[${i}][quantity]" placeholder="Quantity" class="form-control "  value="<?php echo e(old('stock${i}quantity')); ?>">
                            <?php $__errorArgs = ['stock${i}quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger remove-field ">Remove</button>
                        </div>
                    </div>
                </div>
            `);
            i++;
        });

        // Remove dynamically added fields
        $(document).on('click', '.remove-field', function () {
            $(this).parent().parent().remove();
        });
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\LaravelCRUD\resources\views/products/create.blade.php ENDPATH**/ ?>