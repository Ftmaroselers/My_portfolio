<?php
session_start();
include 'db.php';

// OPTIONAL: Only allow logged-in users to view messages
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #050c1a;
            color: #dceaff;
            font-family: "Segoe UI", Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #00eaff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #0a162c;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #1a2948;
        }

        th {
            background: #0e1b33;
            color: #00eaff;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:hover {
            background: #10203b;
        }

        .delete-btn {
            color: #ff4d4d;
            cursor: pointer;
            text-decoration: none;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }

        .back-btn {
            margin-bottom: 20px;
            display: inline-block;
            color: #00eaff;
            text-decoration: none;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <a class="back-btn" href="index.php"><i class="fas fa-arrow-left"></i> Back</a>

    <h2>Contact Messages</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['message']}</td>
                <td>{$row['created_at']}</td>
                <td><a href='messages_delete.php?id={$row['id']}' class='delete-btn'>Delete</a></td>
            </tr>";
            }
        } else {
            echo "
        <tr>
            <td colspan='6' style='text-align:center; padding: 20px;'>No messages found.</td>
        </tr>";
        }
        ?>
    </table>

</body>

</html>