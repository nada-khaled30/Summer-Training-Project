<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
            color: #343a40;
            margin-top: 20px;
        }
        .dashboard-container {
            margin: 20px auto;
            max-width: 900px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .book-item {
            background-color: #e9ecef;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border-left: 5px solid #007bff;
        }
        .book-item h5 {
            color: #007bff;
        }
        .return-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .return-button:hover {
            background-color: #c82333;
        }
        .no-books {
            text-align: center;
            font-style: italic;
            color: #6c757d;
        }
        .view-books-btn {
            display: block;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .view-books-btn:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Dashboard</h1>
    <div class="dashboard-container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('student.books') }}" class="view-books-btn text-center">View Available Books</a>
        <a href="{{ route('student.profile.edit', Auth::guard('student')->user()->id) }}" class="view-books-btn text-center">Edit Profile</a>
        <h2>Borrowed Books</h2>

        @if($borrowedBooks->isEmpty())
            <p class="no-books">No books borrowed yet.</p>
        @else
            <ul class="list-unstyled">
                @foreach($borrowedBooks as $borrowedBook)
                    <li class="book-item">
                        <h5>{{ $borrowedBook->book->title }}</h5>
                        <p>Borrowed on: <strong>{{ $borrowedBook->borrowed_at }}</strong></p>
                        @if(is_null($borrowedBook->return_at))
                            <form action="{{ route('student.books.return') }}" method="POST">
                                @csrf
                                <input type="hidden" name="borrowed_book_id" value="{{ $borrowedBook->id }}">
                                <button type="submit" class="return-button">Return Book</button>
                            </form>
                        @else
                            <p>Returned on: <strong>{{ $borrowedBook->return_at }}</strong></p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
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
