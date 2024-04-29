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

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container">
    	<div class="text-right">
    		<a href="products/Create" class="btn btn-dark mt-2">New Product</a>
            <a href="/profile" class="btn btn-dark mt-2">Profile</a>
            {{-- <a href="/logout" class="btn btn-dark mt-2">Log Out</a> --}}
            <form method="POST" action="{{ route('logout') }}" class="btn btn-dark mt-2">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
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
               	  @foreach($products as $product)
                  <tr>
                       <td>{{ $loop->index+1 }}</td>
                       <td>{{ $product->name }}</td>
                       <td>{{ $product->description }}</td>
                       <td>{{ $product->price }}</td>
                       <td>{{ $product->category?->name }}</td>
                       <td>{{ $product->brand?->name }}</td>
                       {{-- <td>{{ $product->id }}</td> --}}

                       <td>
                             {{-- @if ($product->stocks && count($product->stocks) > 0) --}}
                                <table class="table table-hover mt-2">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stocks as $stock)
                                            <tr>
                                                @if($product->id==$stock->product_id)
                                                  <td>{{ $stock->name }}</td>
                                                  <td>{{ $stock->quantity }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             {{-- @else
                                No stocks available.
                            @endif --}}
                        </td>





                       <td>
                       	<!-- <img src="storage/uploads/{{ $product->image }}" class="rounded-circle" width="50" height="50" /> -->

                        <!-- <img src="storage/app/uploads/{{ $product->image }}" class="rounded-circle" width="50" height="50" /> -->
                        <!-- <img src="{{ url('storage/' . $product->image) }}" class="rounded-circle" width="50" height="50" /> -->
                        <img src="{{ $product->image}}" class="rounded-circle" width="50" height="50" />
                       </td>
                       <td>
                       	<a href="products/{{ $product->id }}/edit" class="btn btn-dark btn-sm">Edit</a>

                       	<a href="products/{{ $product->id }}/delete" class="btn btn-danger btn-sm">Delete</a>

                       </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>


    </div>
</body>
</html>
