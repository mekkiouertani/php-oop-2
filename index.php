<?php

include __DIR__.'/Views/header.php';
include __DIR__.'/Control/Movie.php';
$movies = Movie::fetchAll();
?>

<main class="container">
    <div class="row gy-5">
        <?php
        foreach($movies as $movie) {
            $movie->printCard();
        } ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>