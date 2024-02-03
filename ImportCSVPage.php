<style>
    /* Style for the status message */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    /* Style for the import button */
    .btn-success {
        background-color: #5cb85c;
        border-color: #4cae4c;
        color: #fff;
    }

    /* Style for the CSV file upload form */
    #importFrm {
        margin-top: 20px;
    }

    /* Style for the data list table */
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .thead-dark {
        background-color: #343a40;
        color: #fff;
    }

    /* Style for the "No member(s) found..." message */
    .table td[colspan="5"] {
        text-align: center;
    }
</style>

<?php
// Load the database configuration file
include_once 'core/controller.Class.php';
$db = new Connect;

// Get status message
$statusType = isset($_GET['status']) ? $_GET['status'] : '';
$statusMsg = '';

switch ($statusType) {
    case 'succ':
        $statusType = 'alert-success';
        $statusMsg = 'Members data has been imported successfully.';
        break;
    case 'err':
        $statusType = 'alert-danger';
        $statusMsg = 'Some problem occurred, please try again.';
        break;
    case 'invalid_file':
        $statusType = 'alert-danger';
        $statusMsg = 'Please upload a valid CSV file.';
        break;
}

?>

<!-- Display status message -->
<?php if (!empty($statusMsg)) { ?>
    <div class="col-xs-12">
        <div class="alert <?= $statusType; ?>"><?= $statusMsg; ?></div>
    </div>
<?php } ?>

<div class="row">
    <!-- Import link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');">
                <i class="plus"></i> Import
            </a>
        </div>
    </div>

    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>

    <!-- Data list table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
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
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="5">No member(s) found...</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Show/hide CSV upload form -->
<script>
    function formToggle(ID) {
        var element = document.getElementById(ID);
        element.style.display = (element.style.display === "none") ? "block" : "none";
    }
</script>
