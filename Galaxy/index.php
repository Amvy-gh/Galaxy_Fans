<?php
include 'main.php';
?>


// Galaxy/index.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rimuru Fan Club - Galaxy Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="stars" class="stars"></div>
    <div class="container">
        <h1 class="title">Rimuru Fan Club</h1>

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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" required>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" required>
                                <label class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Interests</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Anime">
                                <label class="form-check-label">Anime</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Manga">
                                <label class="form-check-label">Manga</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="interests[]" value="Games">
                                <label class="form-check-label">Games</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="fandom_level" class="form-label">Fandom Level</label>
                        <select class="form-select" id="fandom_level" name="fandom_level" required>
                            <option value="">Choose Level</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Join the Galaxy</button>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="title h3">Our Star Warriors</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Interests</th>
                        <th>Fandom Level</th>
                        <th>Joined At</th>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>     