<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            margin: 50px auto;
            max-width: 800px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }
        .stat-card {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .stat-card h3 {
            margin: 0;
            font-size: 2rem;
        }
        .stat-card p {
            margin: 0;
            font-size: 1.2rem;
        }
        .buttons-container {
            margin-top: 30px;
            text-align: center;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
        }
        .btn-custom:hover {
            background-color: #218838;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-4">
                <div class="stat-card">
                    <h3>{{ $books }}</h3>
                    <p>Total Books</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h3>{{ $borrowedBooks }}</h3>
                    <p>Borrowed Books</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <h3>{{ $users }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <a href="{{ route('admin.books.index') }}" class="btn btn-custom">View Books</a>
            <a href="{{ route('admin.student.view') }}" class="btn btn-custom">View All Students</a>
            <a href="{{ route('admin.student.search') }}" class="btn btn-custom">Search Students</a>
            <a href="{{ route('admin.profile.edit', ['id' => Auth::user()->id]) }}" class="btn btn-custom">Edit Profile</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    setTimeout(function() {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.remove(); 
    }
}, 2000);

</script>
</body>
</html>
