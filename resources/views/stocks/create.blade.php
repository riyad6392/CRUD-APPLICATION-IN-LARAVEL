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
            <div class="form-group d-flex">
                <div class="mr-2 flex-grow-1">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mr-2 flex-grow-1">
                    <label for="quantity">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                    @if($errors->has('quantity'))
                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-dark">ADD</button>

            </div>


            <div class="container">
                <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th>ModelName</th>
                            <th>Quantity</th>
                            <th>Product_id</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $stock)
                            {{-- @if($stock->product_id == $category->id) --}}
                                <tr>
                                    <td>{{ $stock->name }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->product_id }}</td>
                                    <td>
                                        <a href="stocks/{{ $stock->id }}/delete" class="btn btn-danger btn-sm">Remove</a>
                                    </td>
                                </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>


            <button type="submit" class="btn btn-dark">Submit</button>

          </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
