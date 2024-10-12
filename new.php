<?php
  require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="script.js">
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
    $maxLines = 3;
        $query = "SELECT * FROM New";
        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="anime-card">';
                echo '<img src="' . $row['new_pick'] . '" alt="' . $row['name_new'] . '">';
                echo '<div class="anime-info">';
                echo '<h3>' . $row['name_new'] . '</h3>';
                echo '<button class="read-more" data-name="' . htmlspecialchars($row['name_new']) . '" data-description="' . htmlspecialchars($row['new_description']) . '">Узнать</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Ошибка выполнения запроса: " . mysqli_error($link);
        }
        mysqli_close($link);
    ?>
    </div>
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