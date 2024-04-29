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

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container">
    	<div class="row justify-content-center">
        <div class="col-sm-8">
          <div class="card mt-3 p-3">
            <h3>Product Edit # {{ $product->id }}</h3>
            <form method="POST" action="/products/{{ $product->id }}/update" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}" />
              @if($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name')}}</span>
              @endif
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" row="4" name="description">{{old('description',$product->description)}}</textarea>
              @if($errors->has('description'))
                  <span class="text-danger">{{ $errors->first('description')}}</span>
              @endif
            </div>


            <div class="form-group">
                <label>Price</label>
                <textarea class="form-control" row="4" name="price">{{old('price',$product->price)}}</textarea>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price')}}</span>
                @endif
            </div>

            {{-- <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control" value="{{old('category',$product->category?->name)}}" />
                <input type="hidden" name="category_id" value="{{ old('category_id', $product->category ? $product->category->id : '') }}" />
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category')}}</span>
                @endif
            </div> --}}

            <h1>Category</h1>
            <select name="category_id">
                @foreach($categoris as $category)
                    {{-- <option  value="{{$category->id}}">{{$category->name}}</option> --}}
                    <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>


            <h1>Brand</h1>
            <select name="brand_id">
                @foreach($brands as $brand)
                    {{-- <option  value="{{$brand->id}}">{{$brand->name}}</option> --}}
                    <option value="{{$brand->id}}" @if($brand->id == $product->brand_id) selected @endif>{{$brand->name}}</option>
                @endforeach
            </select>



            {{-- <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand" class="form-control" value="{{old('brand',$product->brand?->name)}}" />
                <input type="hidden" name="brand_id" value="{{ old('brand_id', $product->brand ? $product->brand->id : '') }}" />
                @if($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand')}}</span>
                @endif
            </div> --}}



            <div class="form-group">
              <label>Image</label>
              <input type="file" name="image" class="form-control" />
              @if($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image')}}</span>
              @endif
            </div>


            <h1>Stock</h1>
            <table class="table table-hover mt-2">
                {{-- <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead> --}}
                <tbody>
                    {{-- @foreach($stocks as $key => $stock)
                        <tr>

                              <td><input type="text" name="stock[{{ $key }}][name]" class="form-control" value="{{ old("stock.$key.name", $stock->name) }}" />
                                  <input type="hidden" name="stock[{{ $key }}][id]" value="{{ $stock->id }}">
                                @error("stock.$key.name")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </td>
                              <td><input type="text" name="stock[{{ $key }}][quantity]" class="form-control" value="{{ old("stock.$key.quantity", $stock->quantity) }}" />
                                @error("stock.$key.quantity")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </td>

                        </tr>
                    @endforeach --}}

                    <div id="dynamic-fields">
                        <div class="form-group dynamic-field">

                               @foreach($stocks as $key => $stock)
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="stock[{{ $key }}][name]" class="form-control mt-4" value="{{ old("stock.$key.name", $stock->name) }}" />
                                                <input type="hidden" name="stock[{{ $key }}][id]" value="{{ $stock->id }}">
                                                <input type="hidden" name="stock[{{ $key }}][product_id]" value="{{ $stock->product_id }}">
                                                @error("stock.$key.name")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <input type="text" name="stock[{{ $key }}][quantity]" class="form-control mt-4" value="{{ old("stock.$key.quantity", $stock->quantity) }}" />
                                                @error("stock.$key.quantity")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if($key==0)
                                            <div class="col">
                                                <button type="button" class="btn btn-primary mt-4" id="add-field">Add More</button>
                                            </div>
                                            @else
                                            <div class="col">
                                                <button type="button" class="btn btn-danger remove-field mt-4">Remove</button>
                                            </div>
                                            @endif
                                        </div>

                                    @endforeach



                                            {{-- <div class="col">
                                                <button type="button" class="btn btn-danger remove-field mt-2">Remove</button>
                                            </div> --}}
                                    </div>
                                </div>
                                {{-- <button type="button" class="btn btn-primary mt-2" id="add-field">Add More</button> --}}
                                <!-- End of dynamically added fields -->

                                <button type="submit" class="btn btn-dark mt-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                    <script>
                        $(document).ready(function () {
                            var i = {{ count($stocks) }};
                            var j=1000;
                            $('#add-field').click(function () {
                                $('#dynamic-fields').append(`
                                    <div class="form-group dynamic-field">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="stock[${i}][name]" placeholder="Name" class="form-control" value="{{ old('stock${i}name') }}">
                                                <input type="hidden" name="stock[${i}][id]" value="${j}">
                                                <input type="hidden" name="stock[${i}][product_id]" value="{{ $product->id }}">


                                                @error('stock${i}name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <input type="text" name="stock[${i}][quantity]" placeholder="Quantity" class="form-control "  value="{{ old('stock${i}quantity') }}">

                                                @error('stock${i}quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn btn-danger remove-field ">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                `);
                                i++;
                                j++;
                            });

                            // Remove dynamically added fields
                            $(document).on('click', '.remove-field', function () {
                                $(this).parent().parent().remove();
                            });
                        });
                    </script>




                </tbody>
            </table>



            {{-- <button type="submit" class="btn btn-dark">Submit</button> --}}

          </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
