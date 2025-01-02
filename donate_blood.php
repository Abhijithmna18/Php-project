<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit();
}

include('connection.php'); // Include the database connection file

// Add blood donation logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_blood'])) {
    $blood_type = $_POST['blood_type'];
    $location = $_POST['location'];
    $quantity = $_POST['quantity'];

    // Insert into blood_donations table
    $query = "INSERT INTO blood_donations (blood_type, location, quantity, status) 
              VALUES (?, ?, ?, 'available')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $blood_type, $location, $quantity);
    if ($stmt->execute()) {
        echo "<script>alert('Blood donation added successfully.');</script>";
    } else {
        echo "<script>alert('Error adding blood donation.');</script>";
    }
}

// Edit blood donation logic
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $query = "SELECT * FROM blood_donations WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blood_donation = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_blood'])) {
        $blood_type = $_POST['blood_type'];
        $location = $_POST['location'];
        $quantity = $_POST['quantity'];

        $update_query = "UPDATE blood_donations SET blood_type = ?, location = ?, quantity = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssii", $blood_type, $location, $quantity, $edit_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Blood donation updated successfully.');</script>";
        } else {
            echo "<script>alert('Error updating blood donation.');</script>";
        }
    }
}

// Delete blood donation logic
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM blood_donations WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        echo "<script>alert('Blood donation deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting blood donation.');</script>";
    }
}

// Get all blood donations
$query = "SELECT * FROM blood_donations WHERE status = 'available'";
$result = $conn->query($query); // Execute the query and get the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Blood</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Blood Donations</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">View Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="donation-form">
            <h2>Add New Blood Donation</h2>
            <form method="POST" action="">
                <label for="blood_type">Blood Type:</label>
                <input type="text" name="blood_type" required>

                <label for="location">Location:</label>
                <input type="text" name="location" required>

                <label for="quantity">Quantity (in Liters):</label>
                <input type="number" name="quantity" required>

                <button type="submit" name="add_blood">Add Blood Donation</button>
            </form>
        </section>

        <section class="donation-list">
            <h2>Available Blood Donations</h2>
            <?php if ($result->num_rows > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Blood Type</th>
                            <th>Location</th>
                            <th>Quantity (Liters)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td>
                                    <a href="donate_blood.php?edit_id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                                    <a href="donate_blood.php?delete_id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this blood donation?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No available blood donations at the moment.</p>
            <?php endif; ?>
        </section>

        <?php if (isset($blood_donation)) : ?>
            <!-- Edit Blood Donation Form -->
            <section class="edit-donation-form">
                <h2>Edit Blood Donation</h2>
                <form method="POST" action="">
                    <label for="blood_type">Blood Type:</label>
                    <input type="text" name="blood_type" value="<?php echo $blood_donation['blood_type']; ?>" required>

                    <label for="location">Location:</label>
                    <input type="text" name="location" value="<?php echo $blood_donation['location']; ?>" required>

                    <label for="quantity">Quantity (in Liters):</label>
                    <input type="number" name="quantity" value="<?php echo $blood_donation['quantity']; ?>" required>

                    <button type="submit" name="edit_blood">Update Blood Donation</button>
                </form>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
<style>
    /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7f6;
    color: #333;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 30px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header {
    background-color: #354f52;
    color: white;
    text-align: center;
    padding: 20px 0;
    border-radius: 10px;
}

header h1 {
    font-size: 2.5rem;
    letter-spacing: 1px;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    padding: 12px 24px;
    border-radius: 5px;
    background-color: #52796f;
    transition: background-color 0.3s, transform 0.3s;
}

nav ul li a:hover {
    background-color: #2f3e46;
    transform: scale(1.1);
}

/* Form Section */
.donation-form, .edit-donation-form {
    margin-top: 30px;
    padding: 20px;
    background-color: #e8f2f0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.donation-form h2, .edit-donation-form h2 {
    text-align: center;
    color: #354f52;
    margin-bottom: 20px;
    font-size: 1.8rem;
}

form label {
    display: block;
    font-weight: bold;
    margin: 10px 0 5px;
}

form input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 20px;
    transition: border-color 0.3s ease-in-out;
}

form input:focus {
    border-color: #52796f;
    outline: none;
}

form button {
    background-color: #84a98c;
    color: white;
    font-size: 1.2rem;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

form button:hover {
    background-color: #52796f;
    transform: scale(1.05);
}

/* Table Section */
.donation-list {
    margin-top: 50px;
    text-align: center;
}

.donation-list table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.donation-list th, .donation-list td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 1rem;
}

.donation-list th {
    background-color: #354f52;
    color: white;
    font-size: 1.1rem;
}

.donation-list tr:nth-child(even) {
    background-color: #f9f9f9;
}

.donation-list tr:hover {
    background-color: #e8f2f0;
    cursor: pointer;
}

.donation-list .btn {
    background-color: #84a98c;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.donation-list .btn:hover {
    background-color: #52796f;
    transform: scale(1.05);
}

.donation-list .btn.delete {
    background-color: #d9534f;
}

.donation-list .btn.delete:hover {
    background-color: #c9302c;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 20px;
    }

    nav ul {
        flex-direction: column;
        align-items: center;
    }

    nav ul li {
        margin-bottom: 15px;
    }

    .donation-list table, .donation-form, .edit-donation-form {
        margin-top: 20px;
        width: 100%;
    }

    .donation-list th, .donation-list td {
        font-size: 0.9rem;
        padding: 10px;
    }
}
</style>