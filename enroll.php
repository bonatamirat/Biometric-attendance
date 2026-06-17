<?php
include 'config.php';
requireLogin();

$message = $error = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $fingerprint_id = (int)($_POST['fingerprint_id'] ?? 0);
    if (empty($name) || $fingerprint_id < 1 || $fingerprint_id > 127) {
        $error = "Invalid name or fingerprint ID (must be 1-127).";
    } else {
        try {
            if ($employeesCollection->findOne(['fingerprint_id' => $fingerprint_id])) {
                $error = "Fingerprint ID already exists.";
            } else {
                $employeesCollection->insertOne([
                    'name' => $name,
                    'fingerprint_id' => $fingerprint_id
                ]);
                $message = "Employee enrolled. Use device to scan fingerprint.";
            }
        } catch (Exception $e) {
            $error = "Enrollment failed.";
            error_log("Enroll: MongoDB error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Employee</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Enroll Employee</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Back</a>
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fingerprint ID (1-127)</label>
                <input type="number" name="fingerprint_id" class="form-control" min="1" max="127" required>
            </div>
            <button type="submit" class="btn btn-primary">Enroll</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>