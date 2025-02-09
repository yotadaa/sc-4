<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Plans</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-white p-4 rounded shadow-sm">
        <h2 class="text-center mb-4">Manage Plans</h2>

        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        {{-- Form to add a new plan --}}
        <form action="{{ route('plans.store') }}" method="POST" class="mb-3 d-flex gap-2">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Plan Name" required>
            <button type="submit" class="btn btn-primary">Add Plan</button>
        </form>

        {{-- Table displaying all plans --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td class="text-center">{{ $plan->id }}</td>
                            <td class="text-center">{{ $plan->name }}</td>
                            <td class="text-center">
                                {{-- Edit form --}}
                                <form action="{{ route('plans.update', $plan->id) }}" method="POST" class="d-inline-flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $plan->name }}" required class="form-control form-control-sm w-auto">
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>

                                {{-- Delete form --}}
                                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                {{-- Link to products page --}}
                                <a href="{{ url('/product/' . $plan->id) }}" class="btn btn-success btn-sm">View Products</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
