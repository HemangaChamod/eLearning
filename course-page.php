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

$course_Title_First_Word = explode(' ', $courseTitle)[0];

// Fetch course description
$courseQuery = "SELECT course_description FROM courses WHERE id = $courseId";
$courseResult = mysqli_query($con, $courseQuery); 

if ($row = mysqli_fetch_assoc($courseResult)) {
    $courseDescription = $row['course_description'];
}

// Fetch course modules
$modulesQuery = "SELECT * FROM course_modules WHERE course_id = $courseId ORDER BY id ASC";
$modulesResult = mysqli_query($con, $modulesQuery);

$modules = [];
while ($row = mysqli_fetch_assoc($modulesResult)) {
    $modules[] = $row;
}

// Fetch course skills
$skillsQuery = "SELECT skill FROM course_skills WHERE course_id = $courseId";
$skillsResult = mysqli_query($con, $skillsQuery);

$skills = [];
while ($row = mysqli_fetch_assoc($skillsResult)) {
    $skills[] = $row['skill'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Page</title>
    <link rel="stylesheet" href="course-page-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
    <body>
        <div>
            <nav>
                <div class="logo">
                    <img src="Assets/logoipsum-245.svg" alt="logo">Pro-Skill</div>
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Search courses...">
                        <button class="search-btn">
                            <i class="fa fa-search"></i> 
                        </button>
                    </div>            
                <div class="buttons">
                    <a href="sign-in.html" class="login">Login</a>
                    <a href="sign-up.html" class="sign_in">Sign In</a>
                </div>
            </nav>
    </div>
        <div class="course-intro">
            <img src="fetch_image.php?id=<?= $courseId ?>" alt="" class="course-logo"></img>

            <h2 class="course-title"><?= htmlspecialchars($courseTitle)?></h2>

            <div class="course-details">
                <div class="rating">
                    <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <i class="far fa-star"></i>
                    </span>
                    <span class="rating-count">(5)</span>
                </div>
                <div class="level-container">
                    <span class="level">BEGINNER LEVEL</span>
                </div>
            </div>

            <div class="course-description">
                <p><?= htmlspecialchars($courseDescription)?></p>
            </div>

            <a href="http://localhost/elearning/course-continue.php?id=<?= $courseId ?>" class="enroll-link">
                <button class="enroll-button">Enroll For Free</button>
            </a>
            

            <div class="course-highlights">
                <div class="highlight"><i class="fas fa-check-circle"></i> Learn Python from scratch</div>
                <div class="highlight"><i class="fas fa-check-circle"></i> Hands-on coding exercises</div>
                <div class="highlight"><i class="fas fa-check-circle"></i> Build real-world projects</div>
            </div>

        </div>

        <div class="course-content">
                <h2 class="content-header">What you will learn in this free <?= htmlspecialchars($course_Title_First_Word) ?> course?</h2>

                <?php foreach ($modules as $index => $module): ?>
                    <div class="module">
                        <div class="module-header">
                            <h3>Module <?= $index + 1 ?>: <?= htmlspecialchars($module['module_title']) ?></h3>
                            <span class="time"><i class="fa-solid fa-clock"></i><?= htmlspecialchars($module['module_duration']) ?> hours</span>
                        </div>
                        <p class="module-description"><?= htmlspecialchars($module['module_description']) ?></p>
                        <div class="module-included">
                            <div class="included-item">
                                <h4>What's Included: </h4>
                                <div class="included-icon">
                                    <div class="icon"><i class="fas fa-video included-icon"></i> <?= $module['module_num_videos'] ?> Videos</div>
                                    <div class="icon"><i class="fas fa-book included-icon"></i> <?= $module['module_num_readings'] ?> Readings</div>
                                    <div class="icon"><i class="fas fa-edit included-icon"></i> <?= $module['module_num_quizzes'] ?> Quizzes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
           
            <div class="module">
                <div class="module-header">
                    <h3>Module 5: Final Project</h3>
                    <span class="time"><i class="fa-solid fa-clock"></i>3 hours</span>
                </div>
                <p class="module-description">
                    In this module, you'll learn how to apply a problem-solving framework to tackle a challenging project. You'll learn how to formulate a problem statement to understand a challenge, conduct some research to see what options are available, then begin planning how you to solve a problem.
                </p>
            </div>
        </div>

        <div class="python-skills">
            <h2><?= htmlspecialchars($course_Title_First_Word) ?> Skills You Will Learn</h2>
            <ul>
                <?php foreach ($skills as $skill): ?>
                    <li><i class="fas fa-check-circle"></i> <?= htmlspecialchars($skill) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>


        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100"><g fill="#9F5EFF"><path d="M0 1v99c134.3 0 153.7-99 296-99H0Z" opacity=".5"></path>
            <path d="M1000 4v86C833.3 90 833.3 3.6 666.7 3.6S500 90 333.3 90 166.7 4 0 4h1000Z" opacity=".5"></path><path d="M617 1v86C372 119 384 1 196 1h421Z" opacity=".5"></path><path d="M1000 0H0v52C62.5 28 125 4 250 4c250 0 250 96 500 96 125 0 187.5-24 250-48V0Z"></path></g>
        </svg>

        <div class="learner-reviews">
            <h2>What Our Learners Say</h2>
            <div class="reviews-container">
                <div class="review">
                    <div class="profile-pic">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="review-content">
                        <h4>John Doe</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>This course was extremely helpful in getting me started. Highly recommended!</p>
                    </div>
                </div>
                
                <div class="review">
                    <div class="profile-pic">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="review-content">
                        <h4>Jane Smith</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>Good introduction with clear explanations and examples.</p>
                    </div>
                </div>

                <div class="review">
                    <div class="profile-pic">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="review-content">
                        <h4>Alex Johnson</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>A fantastic course! The explanations were clear, and the hands-on exercises really helped reinforce the concepts.</p>
                    </div>
                </div>
                
                <div class="review">
                    <div class="profile-pic">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="review-content">
                        <h4>Emily Davis</h4>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p>Great course with useful examples. I just wish there were more practice exercises!</p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer-container">
                <div class="col 1">
                    <a href="#"><img class="footer-logo" src="Assets/logoipsum-245.svg" alt=""></a>
                    <p style="margin-right: 10px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore doloremque magni assumenda suscipit
                    </p>
                </div>
                <div class="col 2">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col 3">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col 4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="bi bi-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="bi bi-linkedin"></i> LinkedIn</a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="line">
                <p>Copyright &copy; 2025 | All Rights Reserved</p>
            </div>
    </footer>
</body>

</html>
