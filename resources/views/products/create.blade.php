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
        </ul>
    </nav>

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <form method="POST" action="/products/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" row="4" name="description">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description')}}</span>
                            @endif
                        </div>

                        <h1>Category</h1>
                        <select name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                        <h1>Brand</h1>
                        <select name="brand_id">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                            @if($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image')}}</span>
                            @endif
                        </div>

                        <h1>Stock</h1>

                        <!-- Dynamically added fields -->
                        <div id="dynamic-fields">
                            <div class="form-group dynamic-field">
                                <input type="text" name="stock[0][name]" placeholder="Name"  class="form-control ">
                                <input type="text" name="stock[0][quantity]" placeholder="Quantity" class="form-control mt-4">
                                <button type="button" class="btn btn-danger remove-field mt-4">Remove</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-2" id="add-field">Add More</button>
                        <!-- End of dynamically added fields -->

                        <button type="submit" class="btn btn-dark">Submit</button>
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
                        <input type="text" name="stock[${i}][name]" placeholder="Name" class="form-control" >
                        <input type="text" name="stock[${i}][quantity]" placeholder="Quantity" class="form-control mt-4">
                        <button type="button" class="btn btn-danger remove-field mt-4">Remove</button>
                    </div>
                `);
                i++;
            });

            // Remove dynamically added fields
            $(document).on('click', '.remove-field', function () {
                $(this).parent().remove();
            });
        });
    </script>
</body>
</html>
