<?php

$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) die("Connection failed: " . mysqli_connect_error());

$courses_sql = "SELECT * FROM courses";
$courses_result = mysqli_query($con, $courses_sql);

$module_sql = "SELECT * FROM course_modules";
$module_result = mysqli_query($con, $module_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="admin-panel-styles.css" />
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Course Management</h1>
      <a href="add_course.php" class="btn add-btn">+ Add Course</a>
    </div>
    
    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Title</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($course = mysqli_fetch_assoc($courses_result)): ?>
        <tr>
          <td><img src="fetch_image.php?id=<?= $courseId?>" class="thumbnail" alt="<?= htmlspecialchars($course['course_title']) ?>"></td>
          <td><?= htmlspecialchars($course['course_title']) ?></td>
          <td><?= htmlspecialchars($course['course_description']) ?></td>
          <td>
            <div class="action-buttons">
              <a href="edit_course.php?id=<?= $course['id'] ?>" class="btn btn-edit">Edit</a>
              <a href="delete_course.php?id=<?= $course['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this course?')">Delete</a>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <div class="container" style="margin-top: 55px;">
    <div class="header">
      <h1>Module Management</h1>
      <a href="add_module.php" class="btn add-btn">+ Add Module</a>
    </div>
    
    <table>
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Title</th>
          <th>Duration</th>
          <th>Description</th>
          <th>Num of Videos</th>
          <th>Num of Reading</th>
          <th>Num of Quizzes</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($module = mysqli_fetch_assoc($module_result)): ?>
        <tr>
          <td><?= htmlspecialchars($module['course_id']) ?></td>
          <td><?= htmlspecialchars($module['module_title']) ?></td>
          <td><?= htmlspecialchars($module['module_duration']) ?></td>
          <td><?= htmlspecialchars($module['module_description']) ?></td>
          <td><?= htmlspecialchars($module['module_num_videos']) ?></td>
          <td><?= htmlspecialchars($module['module_num_readings']) ?></td>
          <td><?= htmlspecialchars($module['module_num_quizzes']) ?></td>
          
          <td>
            <div class="action-buttons">
              <a href="edit_course.php?id=<?= $module['id'] ?>" class="btn btn-edit">Edit</a>
              <a href="delete_course.php?id=<?= $module['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete this module?')">Delete</a>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
