<?php 
    require_once 'autoload.php';
    $conn = new Connection();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Note App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- <h1>Abdullah Almamun</h1> -->
    <section class="na-body">
        <h1>Add note from here</h1>
        <form action="#" method="post">
            <input type="text" name="title" autocomplete="off">
            <textarea name="description" autocomplete="off" ></textarea>
            <input type="submit" value="Add Note">
        </form>

        <?php 
            $notes = $conn->getNotes();
            foreach ( $notes as $note ):
            
        ?>
            <div class="na-note">
                <h3  class="na-note-top">
                    <a href="#" class="na-title"><?php echo $note['title'] ?></a>
                    <div class="na-xmark">
                        <form action="#" method="post">
                            <input type="hidden" name="noteId">
                            <input type="submit" value="X" class="na-delete-note">
                        </form>
                    </div>
                </h3>
                <div class="na-note-body">
                    <?php echo $note['description'] ?>
                </div>
                <div class="na-note-bottom">
                    <!-- 21/01/24  2:00 PM -->
                    <?php echo $note['created_at'] ?>
                </div>
            </div>
        <?php 
            endforeach;
        ?>
    </section>

</body>
</html>