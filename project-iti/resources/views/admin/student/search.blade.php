<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .student-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .student-details h2 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .student-details p {
            font-size: 18px;
            color: #555;
        }
        .no-student {
            text-align: center;
            font-size: 18px;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Search</h1>
    
    <form action="{{ route('admin.student.search') }}" method="GET" class="d-flex justify-content-center mb-5">
    <input type="text" name="student_id" class="form-control w-50" placeholder="Enter Student ID" required>
    <button type="submit" class="btn btn-primary ms-2">Search</button>
    </form>

    @if($student)
        <div class="student-details">
            <h2>Student Details</h2>
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Books Borrowed:</strong> {{ $student->borrowedBooks->count() }}</p>
        </div>
    @else
        <p class="no-student">No student found with this ID.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
