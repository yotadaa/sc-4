<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $plans->name }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-white p-4 rounded shadow-sm">
        <h2 class="mb-4 text-center">{{ $plans->name }}</h2>

        {{-- Form to add a new product --}}
        <h4 class="text-center">Add a Product</h4>
        <form action="{{ route('products.store', ['id' => $plans->id]) }}" method="POST" enctype="multipart/form-data"
            class="mb-4">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="plan_id" value="{{ $plans->id }}">

                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" name="qty" id="qty"
                    class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}" required>
                @error('qty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" name="price" id="price"
                    class="form-control @error('price') is-invalid @enderror" step="0.01"
                    value="{{ old('price') }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Product Image</label>
                <input type="file" name="foto" id="foto"
                    class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success w-100">Add Product</button>
        </form>


        <hr>

        {{-- Table displaying all products --}}
        <h4 class="text-center">Products List</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Check</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans->products as $product)
                    <tr>
                        <td>
                            <form action="{{ route('product.check', ['plan_id' => $plans->id, 'id' => $product->id]) }}" method="POST">
                                @csrf
                                @method('PATCH') <!-- Use PATCH for updates -->
                                <button type="submit" class="btn @if ($product->checked) btn-secondary @else btn-success btn-sm @endif">
                                    @if ($product->checked) Uncheck @else Check @endif
                                </button>
                            </form>
                        </td>

                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src="{{ asset('storage/' . $product->foto) }}" alt="Product Image"
                                class="img-thumbnail" style="width: 50px;"></td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>

                            {{-- Delete Form --}}
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Back button --}}
        <div class="text-center">
            <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
