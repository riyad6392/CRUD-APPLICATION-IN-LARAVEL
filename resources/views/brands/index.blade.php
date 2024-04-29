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
     <li class="nav-item">
      <a class="nav-link text-light" href="Create">Category</a>
    </li>
  </ul>

</nav>

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <strong>{{ $message }}</strong>
        </div>
    @endif

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
               	  @foreach($brands as $brand)
                  <tr>
                       <td>{{ $loop->index+1 }}</td>
                       <td>{{ $brand->name }}</td>
                       <td>
                       	<a href="{{ $brand->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                       	<a href="{{ $brand->id }}/delete" class="btn btn-danger btn-sm">Delete</a>

                       </td>
                  </tr>
                  @endforeach
                </tbody>
            </table>


    </div>
</body>
</html>
