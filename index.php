<?php 
    require_once 'autoload.php';
    $conn = new Connection();

    if(isset($_POST)){
        if( isset($_POST['type'])){
            if(empty($_POST['title'])){
                header('location:./?empty=title');
            }else{
                if($_POST['type'] == 'addNote'){
                    $conn->addNote($_POST);

                }elseif ($_POST['type'] == 'updateNote') {
                    $conn->updateNote($_POST);
                }
            }
        }

        if( !isset($_GET['id'])){
            $noteById = array(
                'id'            => '',
                'title'         => '',
                'description'   => ''
            );
            $type = 'addNote';
            $buttonText = 'Add Note';
            $forUpdate = '';

        }else{
            $noteById = $conn->getNotesById($_GET['id']);
            $type = 'updateNote';
            $buttonText = 'Update Note';
            $forUpdate = '<input name="id" type="hidden" value="'.$_GET['id'].'">';
        }
    }
    if(isset($_POST['deleteNote'])){
        $conn->deleteNote($_POST['noteId']);
    }

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
    <section class="na-body">
        <h1>Add note from here</h1>
        <form action="./" method="post">
            <?= $forUpdate ?>
            <input type="hidden" name="type" value="<?= $type ?>" >
            <input type="text" name="title" autocomplete="off" value="<?= $noteById['title']; ?>" >
            <textarea name="description" autocomplete="off" ><?= $noteById['description']; ?></textarea>
            <?php if(isset($_GET['empty'])){ echo 'Title can\'t be empty. '; } ?>
            <input type="submit" value="<?= $buttonText ?>">
        </form>

        <?php 
            $notes = $conn->getNotes();
            foreach ( $notes as $note ):
            
        ?>
            <div class="na-note">
                <h3  class="na-note-top">
                    <a href="./?id=<?php echo $note['id']; ?>" class="na-title"><?php echo $note['title'] ?></a>
                    <div class="na-xmark">
                        <form action="./" method="post">
                            <input type="hidden" name="noteId" value="<?= $note['id'] ?>">
                            <input type="submit" name="deleteNote" value="X" class="na-delete-note">
                        </form>
                    </div>
                </h3>
                <div class="na-note-body">
                    <?php echo $note['description'] ?>
                </div>
                <div class="na-note-bottom">
                    <?php echo $note['created_at'] ?>
                </div>
            </div>
        <?php 
            endforeach;
        ?>
    </section>

</body>
</html>