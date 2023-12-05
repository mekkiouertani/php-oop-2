<?php
include __DIR__ . "/Views/header.php";
include __DIR__ . "/Control/Games.php";
$games = Games::fetchAll();
?>

<section>
    <div class="container">
        <div class="row">
            <?php
            foreach ($games as $game) {
                $game->printCard();
            }
            ?>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>