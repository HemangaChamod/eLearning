<?php
$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) die("Connection failed: " . mysqli_connect_error());

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_title = $_POST['course_title'];
    $course_description = $_POST['course_description'];
    $course_image = $_FILES['course_image']['name'];
    move_uploaded_file($_FILES['course_image']['tmp_name'], "Assets/" . $course_image);

    $sql = "INSERT INTO courses (course_image, course_title, course_description) VALUES ('$course_image', '$course_title', '$course_description')";
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
  <title>Add Course - Admin Panel</title>
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

    .success-message {
      margin-top: 20px;
      background-color: #d4edda;
      color: #155724;
      padding: 12px 16px;
      border: 1px solid #c3e6cb;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
    }

  </style>
</head>
<body>
  <div class="add-course-wrapper">
    <h1>Add New Course</h1>
    
    <?php if (!empty($success_message)): ?>
      <div style="color: green; margin-bottom: 15px;"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
      <div style="color: red; margin-bottom: 15px;"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form class="add-course-form" action="add_course.php" method="POST" enctype="multipart/form-data">
      <label for="course_image">Course Image</label>
      <input type="file" id="course_image" name="course_image" required />

      <label for="course_title">Course Title</label>
      <input type="text" id="course_title" name="course_title" required />

      <label for="course_description">Course Description</label>
      <textarea id="course_description" name="course_description" rows="4" required></textarea>

      <div class="add-course-actions">
        <button type="submit" class="btn-add-course">Add Course</button>
        <a href="http://localhost/elearning/admin-panel.php" class="btn-cancel">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
