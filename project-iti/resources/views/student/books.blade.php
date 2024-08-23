<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-top: 20px;
            text-align: center;
            color: #343a40;
        }
        .book-list {
            margin: 20px auto;
            max-width: 800px;
        }
        .book-item {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .book-item h5 {
            color: #007bff;
        }
        .book-item form {
            margin-top: 10px;
        }
        .borrow-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .borrow-button:hover {
            background-color: #0056b3;
        }
        .alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            width: 80%;
            max-width: 500px;
            text-align: center;
            font-size: 40px;
        }
        .alert.hidden {
            opacity: 0;
            visibility: hidden;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Available Books</h1>

    @if ($errors->any())
        <div class="alert alert-danger" id="error-alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
        </div>
    @endif

    <div class="book-list">
        <ul class="list-unstyled">
            @foreach($books as $book)
                <li class="book-item">
                    <h5>{{ $book->title }} by {{ $book->author }}</h5>
                    <p><strong>{{ $book->copies }}</strong> copies available</p>
                    <form action="{{ route('student.books.borrow') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="borrow-button">Borrow</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.classList.add('hidden');
            }, 3000); 
        }
    });
</script>

</body>
</html>
