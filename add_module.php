<?php
$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) die("Connection failed: " . mysqli_connect_error());

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST
    $course_ID = $_POST['course_ID'];
    $module_title = $_POST['module_title'];
    $duration = $_POST['duration'];
    $module_description = $_POST['module_description'];
    $num_of_videos = $_POST['num_of_videos'];
    $num_of_reading = $_POST['num_of_reading'];
    $num_of_quizzes = $_POST['num_of_quizzes'];

    // Insert into course_modules table
    $sql = "INSERT INTO course_modules 
            (course_ID, module_title, duration, module_description, num_of_videos, num_of_reading, num_of_quizzes) 
            VALUES 
            ('$course_ID', '$module_title', '$duration', '$module_description', '$num_of_videos', '$num_of_reading', '$num_of_quizzes')";

    if ($con->query($sql) === TRUE) {
      $success_message = "Course added successfully!";
    } else {
      $error_message = "Database error: " . $con->error;
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Module - Admin Panel</title>
  <link rel="stylesheet" href="admin-panel-styles.css" />
  <style>
    .add-course-wrapper {
      max-width: 700px;
      margin: 40px auto;
      background-color: #fff;
      padding: 35px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .add-course-wrapper h1 {
      text-align: center;
      font-size: 28px;
      color: #333;
      margin-bottom: 25px;
    }

    .add-course-form label {
      font-weight: bold;
      display: block;
      margin-bottom: 8px;
      color: #555;
    }

    .add-course-form input[type="text"],
    .add-course-form input[type="file"],
    .add-course-form textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      margin-bottom: 20px;
      box-sizing: border-box;
    }

    .add-course-form textarea {
      resize: vertical;
    }

    .add-course-actions {
      display: flex;
      justify-content: flex-start;
      gap: 15px;
      margin-top: 15px;
    }

    .btn-add-course {
      padding: 10px 24px;
      background-color: #28a745;
      color: white;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-add-course:hover {
      background-color: #218838;
    }

    .btn-cancel {
      padding: 10px 24px;
      background-color: #dc3545;
      color: white;
      font-weight: bold;
      text-decoration: none;
      border-radius: 6px;
      transition: background 0.3s ease;
    }

    .btn-cancel:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>
  <div class="add-course-wrapper">
    <h1>Add New Module</h1>
    <form class="add-course-form" action="add_module.php" method="POST" enctype="multipart/form-data">
      <label for="course_ID">Course ID</label>
      <input type="number" id="course_ID" name="course_ID" required />

      <label for="module_title">Module Title</label>
      <input type="text" id="module_title" name="module_title" required />

      <label for="duration">Duration</label>
      <input type="number" id="duration" name="duration" required />

      <label for="module_description">Module Description</label>
      <textarea id="module_description" name="module_description" rows="4" required></textarea>

      <label for="num_of_videos">Number of Videos</label>
      <input type="number" id="num_of_videos" name="num_of_videos" required />

      <label for="num_of_reading">Number of Reading</label>
      <input type="number" id="num_of_reading" name="num_of_reading" required />

      <label for="num_of_quizzes">Number of Quizzes</label>
      <input type="number" id="num_of_quizzes" name="num_of_quizzes" required />

      <div class="add-course-actions">
        <button type="submit" class="btn-add-course">Add Module</button>
        <a href="admin_panel.php" class="btn-cancel">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>