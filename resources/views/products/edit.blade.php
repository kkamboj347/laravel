<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
       <h3 class="text-white text-center">Laravel Crud Operations</h3>
   </div>
   <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
          <div class="card border-0 shadow-lg my-5">
            <div class="card-header">
              <h3 class="text-center text-capitalize">Create Product</h3>
            </div>
            <form enctype="multipart/form-data" action ="{{ route('products.update',$product->id) }}" method="post">
            @method('put')  
            @csrf
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label h6">Name</label>
                  <input value="{{ old('name',$product->name) }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Enter Name" name="name">
                  @error('name')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label h6">Sku</label>
                  <input value="{{ old('sku',$product->sku) }}" type="text" class="@error('sku') is-invalid @enderror form-control form-cotrol-lg" placeholder="Enter Sku" name="sku">
                  @error('sku')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label h6">Price</label>
                  <input type="text" value="{{ old('price',$product->price) }}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Enter Price" name="price">
                  @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label h6">Description</label>
                  <textarea value="{{ old('description') }}"class="@error('description') is-invalid  @enderror form-control form-control-lg" cols="30" rows="5" placeholder="Enter Description" name="description">{{ old('description',$product->description) }}</textarea>
                  @error('description')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <label for="" class="form-label h6">Image</label>
                  <input value="{{ old('file') }}" type="file" name="file" class="@error('file') is-invalid @enderror form-control form-control-lg">
                  @if ($product->image != '')
                    <img width="50" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
                    @endif
                  @error('file')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="card-body">
                <div class="d-grid">
                  <button class="btn btn-lg btn-primary">Update</button>
                </div>
              </div>
            </div>
          </form>
       </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>