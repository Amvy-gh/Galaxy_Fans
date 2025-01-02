<?php
include '../includes/main.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galaxy Fan Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Gaya tambahan untuk tombol */
        .btn {
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="stars" class="stars"></div>
    <div class="container">
        <h1 class="title text-center my-4">Galaxy Fan Club</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success text-center mb-4 fade show">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-body p-4">
                <form id="fanForm" method="POST" action="" class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Astronaut Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your intergalactic name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cosmic Gender</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Star Male" required>
                                <label class="form-check-label">Star Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Galaxy Female" required>
                                <label class="form-check-label">Galaxy Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cosmic Interests</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Stargazing">
                                <label class="form-check-label">Stargazing</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Rocketry">
                                <label class="form-check-label">Rocketry</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Black Holes">
                                <label class="form-check-label">Black Holes</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="fandom_level" class="form-label">Galactic Level</label>
                        <select class="form-select" id="fandom_level" name="fandom_level" required>
                            <option value="">Select Galactic Rank</option>
                            <option value="Rookie Astronaut">Rookie Astronaut</option>
                            <option value="Space Explorer">Space Explorer</option>
                            <option value="Cosmic Commander">Cosmic Commander</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Join the Galaxy!</button>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="title h3 text-center my-4">Our Star Warriors</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Interests</th>
                        <th>Galactic Level</th>
                        <th>Joined At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fans as $fan): ?>
                        <tr>
                            <td><?php echo $fan['id']; ?></td>
                            <td><?php echo htmlspecialchars($fan['name']); ?></td>
                            <td><?php echo htmlspecialchars($fan['gender']); ?></td>
                            <td><?php echo htmlspecialchars($fan['interests']); ?></td>
                            <td><?php echo htmlspecialchars($fan['fandom_level']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($fan['created_at'])); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Delete Button -->
                                    <a href="../actions/delete.php?id=<?php echo $fan['id']; ?>" 
                                       class="btn btn-outline-danger btn-sm d-flex align-items-center"
                                       onclick="return confirm('Are you sure you want to delete this record?')">
                                       <i class="fas fa-trash-alt me-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
