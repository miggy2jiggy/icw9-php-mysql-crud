<?php
require 'db.php';

$sql = "SELECT * FROM employees ORDER BY emp_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Employee Management System</title>

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<div class="container">

    <h1>Employee Management System</h1>

    <a href="add_employee.php" class="add-button">
        Add New Employee
    </a>

    <?php if ($result && $result->num_rows > 0): ?>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($row = $result->fetch_assoc()): ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($row["emp_id"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["first_name"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["last_name"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["email"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["job_title"]); ?>
                    </td>

                    <td>
                        $<?php echo number_format($row["salary"], 2); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row["hire_date"]); ?>
                    </td>

                    <td>

                        <a
                            href="edit_employee.php?id=<?php echo $row["emp_id"]; ?>"
                            class="edit-button"
                        >
                            Edit
                        </a>

                        <a
                            href="delete_employee.php?id=<?php echo $row["emp_id"]; ?>"
                            class="delete-button"
                            onclick="return confirm('Are you sure you want to delete this employee?');"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    <?php else: ?>

        <p class="empty-message">
            No employees found.
        </p>

    <?php endif; ?>

</div>

</body>

</html>

<?php
$conn->close();
?>