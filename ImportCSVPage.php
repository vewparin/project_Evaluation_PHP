<?php
require_once('core/controller.Class.php');
$db = new Connect;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management</title>

    <!-- Add Bootstrap and FontAwesome CDN links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        /* Your existing styles remain here */

        /* Improved header styling */
        .page-header {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            margin-bottom: 20px;
        }

        /* Consistent button styling */
        .btn {
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-success{
            margin-bottom: 12px;
        }

        #importFrm {
            margin-top: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #importFrm input[type="file"] {
            margin-bottom: 10px;
        }

        #importFrm input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }

        #importFrm input[type="submit"]:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Improved header -->
        <div class="row">
            <div class="col-md-12 page-header">
                <h2>Member Management</h2>
            </div>
        </div>

        <!-- Display status message -->
        <?php if (!empty($statusMsg)) { ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert <?= $statusType; ?>"><?= $statusMsg; ?></div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <!-- Import link -->
            <div class="col-md-12">
                <div class="float-right">
                    <button class="btn btn-success" onclick="formToggle('importFrm')">
                        <i class="fas fa-plus"></i> Import
                    </button>
                    <!-- Add other buttons here if needed -->
                </div>
            </div>

            <!-- CSV file upload form -->
            <div class="col-md-12" id="importFrm" style="display: none;">
                <form action="importData.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" class="form-control-file">
                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                </form>
            </div>

            <!-- Data list table -->
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Get member rows
                        $stmt = $db->query("SELECT * FROM members ORDER BY id DESC");
                        if ($stmt) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['phone']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <a href="deleteData.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this member?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No member(s) found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Show/hide CSV upload form -->
    <script>
        function formToggle(ID) {
            var element = document.getElementById(ID);
            element.style.display = (element.style.display === "none") ? "block" : "none";
        }
    </script>

    <!-- Add Bootstrap and Popper.js CDN links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>