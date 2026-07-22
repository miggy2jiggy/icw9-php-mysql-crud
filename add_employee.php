<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $job_title = trim($_POST["job_title"]);
    $salary = trim($_POST["salary"]);
    $hire_date = trim($_POST["hire_date"]);

    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($email) ||
        empty($job_title) ||
        empty($salary) ||
        empty($hire_date)
    ) {
        $message = "Please complete every field.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (!is_numeric($salary) || $salary < 0) {
        $message = "Please enter a valid salary.";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO employees
            (first_name, last_name, email, job_title, salary, hire_date)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssds",
            $first_name,
            $last_name,
            $email,
            $job_title,
            $salary,
            $hire_date
        );

        if ($stmt->execute()) {
            $stmt->close();

            header("Location: index.php");
            exit;
        } else {
            $message = "Employee could not be added.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Employee</title>

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<div class="container form-container">

    <h1>Add New Employee</h1>

    <?php if (!empty($message)): ?>

        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php endif; ?>

    <form method="POST" action="">

        <label for="first_name">
            First Name
        </label>

        <input
            type="text"
            id="first_name"
            name="first_name"
            value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ""; ?>"
            required
        >

        <label for="last_name">
            Last Name
        </label>

        <input
            type="text"
            id="last_name"
            name="last_name"
            value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ""; ?>"
            required
        >

        <label for="email">
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo isset($email) ? htmlspecialchars($email) : ""; ?>"
            required
        >

        <label for="job_title">
            Job Title
        </label>

        <input
            type="text"
            id="job_title"
            name="job_title"
            value="<?php echo isset($job_title) ? htmlspecialchars($job_title) : ""; ?>"
            required
        >

        <label for="salary">
            Salary
        </label>

        <input
            type="number"
            id="salary"
            name="salary"
            min="0"
            step="0.01"
            value="<?php echo isset($salary) ? htmlspecialchars($salary) : ""; ?>"
            required
        >

        <label for="hire_date">
            Hire Date
        </label>

        <input
            type="date"
            id="hire_date"
            name="hire_date"
            value="<?php echo isset($hire_date) ? htmlspecialchars($hire_date) : ""; ?>"
            required
        >

        <div class="button-row">

            <button
                type="submit"
                class="add-submit-button"
            >
                Add Employee
            </button>

            <a
                href="index.php"
                class="cancel-button"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

</body>

</html>

<?php
$conn->close();
?>