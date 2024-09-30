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
        <a href="main.html" class="logo">Logo</a>
        <nav class="navbar"> 
            <a href="#">Новинки</a>
            <a href="anime.php">Аниме</a>
            <a href="#">Манга</a>
            <a href="#">Персонажи</a>
            <button>Вход</button>
        </nav>
    </header>
    <div class="anime-cards">
    <?php
    $maxLines = 3;
        $query = "SELECT * FROM Anime";
        $result = mysqli_query($link, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="anime-card">';
                echo '<img src="' . $row['anime_pick'] . '" alt="' . $row['anime_name'] . '">';
                echo '<div class="anime-info">';
                echo '<h3>' . $row['anime_name'] . '</h3>';
                echo '<p class="anime-description" data-full-text="' . htmlspecialchars($row['anime_description']) . '">'
                . nl2br(htmlspecialchars(implode(' ', array_slice(explode(' ', $row['anime_description']), 0, $maxLines * 10)))) 
                . '...</p>';
                echo '<button class="read-more">Читать далее</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Ошибка выполнения запроса: " . mysqli_error($link);
        }
        mysqli_close($link);
    ?>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreButtons = document.querySelectorAll('.read-more');

        readMoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const description = this.previousElementSibling;
                const fullText = description.dataset.fullText; 
                if (description.classList.contains('expanded')) {
                    description.classList.remove('expanded');
                    this.textContent = 'Читать далее';
                    description.innerHTML = description.dataset.fullText.split('<br>').slice(0, 3).join('<br>') + '...';
                } else {
                    description.classList.add('expanded');
                    this.textContent = 'Скрыть'; 
                    description.innerHTML = fullText;
                }
            });
        });
    });
</script>

</body>
</html>