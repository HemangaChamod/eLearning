<?php
$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $courseId = intval($_GET['id']);
} 

// Query to fetch the image from the database
$query = "SELECT course_image FROM courses WHERE id = $courseId";  
$result = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($result)) {
    // Set the content type for the image (based on your image type, adjust accordingly)
    header("Content-Type: image/png"); // Change to image/jpeg or image/gif if needed
    echo $row['course_image'];  // Output the binary image data
} 

mysqli_close($con);
?>
