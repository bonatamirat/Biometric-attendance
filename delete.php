<?php
include 'config.php';
requireLogin();

$message = $error = null;
if (isset($_GET['id'])) {
    $fingerprint_id = (int)$_GET['id'];
    try {
        $deleteResult = $employeesCollection->deleteOne(['fingerprint_id' => $fingerprint_id]);
        if ($deleteResult->getDeletedCount() > 0) {
            $message = "Employee deleted. Use device to remove fingerprint.";
        } else {
            $error = "Deletion failed.";
        }
    } catch (Exception $e) {
        $error = "Deletion failed.";
        error_log("Delete: MongoDB error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Delete Employee</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Back</a>
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>