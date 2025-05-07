<?php
$con = mysqli_connect("localhost", "root", "", "elearning");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $courseId = intval($_GET['id']);
} else {
    die("Oops! We couldn't find the course you're looking for");
}

// Fetch course title
$courseQuery = "SELECT course_title FROM courses WHERE id = $courseId";
$courseResult = mysqli_query($con, $courseQuery); 

if ($row = mysqli_fetch_assoc($courseResult)) {
    $courseTitle = $row['course_title'];
}

// Fetch modules
$query = "SELECT cm.id, cm.module_title, v.video_id, cm.module_num_videos, cm.module_num_readings, cm.module_num_quizzes 
          FROM course_modules cm
          JOIN videos v ON cm.id = v.module_id 
          WHERE cm.course_id = $courseId";
$result = mysqli_query($con, $query);

$modules = [];
while ($row = mysqli_fetch_assoc($result)) {
    $modules[] = $row;
}

// Get selected module from URL (default is 0)
$selectedModuleIndex = isset($_GET['module']) ? intval($_GET['module']) : 0;

// Ensure selected module index is valid
$selectedModule = $modules[$selectedModuleIndex] ?? $modules[0];

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="course-continue-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <h2 class="course-title"><?= htmlspecialchars($courseTitle) ?></h2>

        <?php foreach ($modules as $index => $module): ?>
            <a href="?id=<?= $courseId ?>&module=<?= $index ?>">
                <div class="module <?= $index === $selectedModuleIndex ? 'active' : '' ?>">
                    <?= htmlspecialchars($module['module_title']) ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="content">
        <div class="course-header">
            <h2 id="moduleTitle"><?= htmlspecialchars($selectedModule['module_title']) ?></h2>
            <div class="module-included">
                <div class="included-item">
                    <div class="included-icon">
                        <div class="icon"><i class="fas fa-video included-icon"></i> <?= htmlspecialchars($selectedModule['module_num_videos']) ?> Videos</div>
                        <div class="icon"><i class="fas fa-book included-icon"></i> <?= htmlspecialchars($selectedModule['module_num_readings']) ?> Readings</div>
                        <div class="icon"><i class="fas fa-edit included-icon"></i> <?= htmlspecialchars($selectedModule['module_num_quizzes']) ?> Quizzes</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-container">
            <iframe id="videoPlayer" src="https://player.vimeo.com/video/<?= htmlspecialchars($selectedModule['video_id']) ?>" allowfullscreen></iframe>
        </div>
    </div>
</body>
</html>
