<?php
  require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>AnimeArchive</title>
</head>
<body>
<header class="header">
    <a href="main.html" class="logo">
        <img src="assets/img/Logo.png" alt="Logo" style="height: 50px;">
    </a>
    <nav class="navbar"> 
        <a href="new.php">Новинки</a>
        <a href="anime.php">Аниме</a>
        <a href="manga.php">Манга</a>
        <a href="#">Персонажи</a>
        <button>Вход</button>
    </nav>
</header>

<div class="anime-cards">
    <?php
    $query = "SELECT * FROM Anime";
    $result = mysqli_query($link, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="anime-card">';
            echo '<img src="' . $row['anime_pick'] . '" alt="' . $row['anime_name'] . '">';
            echo '<div class="anime-info">';
            echo '<h3>' . $row['anime_name'] . '</h3>';
            echo '<button class="read-more" data-name="' . htmlspecialchars($row['anime_name']) . '" data-description="' . htmlspecialchars($row['anime_description']) . '">Узнать</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($link);
    }
    mysqli_close($link);
    ?>
</div>

<!-- Модальное окно -->
<div id="animeModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalTitle"></h2>
        <p id="modalDescription"></p>
    </div>
</div>
<!-- модальное окно -->
<script>
    const modal = document.getElementById("animeModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalDescription = document.getElementById("modalDescription");
    const closeModal = document.querySelector(".modal .close");

    closeModal.onclick = function() {
        modal.style.display = "none"; 
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; 
        }
    }

    document.querySelectorAll('.read-more').forEach(button => {
        button.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const description = this.getAttribute('data-description');
            modalTitle.textContent = name;
            modalDescription.textContent = description;
            modal.style.display = "flex";
        });
    });
</script>


</body>
</html>
