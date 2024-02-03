<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');

if ($_POST) {
    $filename = '';

    if (!empty($_FILES['file'])) {

        $targetDirectory = "../../uploads/";
        $file = $_FILES['file']['name'];

        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];

        $tmpName = $_FILES['file']['tmp_name'];
        $path_filename_ext = $targetDirectory . $filename . '.' . $ext;
        if (move_uploaded_file($tmpName, $path_filename_ext)) {
            $filename = $filename . '.' . $ext;
        }
    }

    $sql = "INSERT INTO item (title, description, file, category_id, duration, type) VALUES (?,?,?,?,?,?)";
    $a = $pdo->prepare($sql)->execute([$_POST['title'], $_POST['description'], $filename, $_POST['category'], $_POST['duration'], $_POST['type']]);
}

$stm = $pdo->query("SELECT id, name FROM category");

$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>
                        <label>
                            <input type="radio" id="type1" name="type" value="0" checked>
                            serie
                        </label>
                        <label>
                            <input type="radio" id="type2" name="type" value="1">
                            movie
                        </label>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="number" class="form-control" name="duration" id="duration">
                        </div>
                        <div class="form-group">
                            <label for="name">Category</label>
                            <select class="form-control" id="category" name="category">
                                <?php foreach ($categories as $c) { ?>
                                    <option value="<?=$c['id']?>"><?=$c['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control-file" name="file" id="file">
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