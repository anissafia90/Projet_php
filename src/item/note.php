<?php

require_once (__DIR__ . '/../../config/database.php');

if ($_POST) {
    $sql = "INSERT INTO note (user_id, item_id, note, comment) VALUES (?,?,?,?)";
    $pdo->prepare($sql)->execute([$_SESSION['user_id'], $_GET['id'], strip_tags($_POST['note']), strip_tags($_POST['comment'])]);
    header("Location:../item/index.php");
    exit();
}

require_once (__DIR__ . '/../../includes/header.php');
?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="note">Note</label>
                            <input type="number" max="5" min="0" class="form-control" name="note" id="note">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <input type="text" class="form-control" name="comment" id="comment">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');

?>