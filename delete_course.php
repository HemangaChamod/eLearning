<?php
// Connect to DB
$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) die("Connection failed: " . mysqli_connect_error());

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Delete related skills, modules, and videos first
    $con->query("DELETE FROM course_skills WHERE course_id=$course_id");
    $con->query("DELETE FROM course_modules WHERE course_id=$course_id");
    $con->query("DELETE FROM videos WHERE module_id IN (SELECT id FROM course_modules WHERE course_id=$course_id)");

    // Now delete the course itself
    $delete_sql = "DELETE FROM courses WHERE id=$course_id";
    if ($con->query($delete_sql) === TRUE) {
        echo "Course deleted successfully!";
        header("Location: http://localhost/elearning/admin-panel.php"); // Redirect after deletion
        exit;
    } else {
        echo "Error deleting course: " . $con->error;
    }
}
?>
