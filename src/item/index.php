<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');

$rows = [];
if ($_GET) {
    $stm = $pdo->prepare("SELECT i.*, AVG(n.note) as moy FROM item as i INNER JOIN note as n ON i.id = n.item_id WHERE i.title LIKE ? AND i.type = ? AND i.category_id = ? GROUP BY n.item_id");
    $stm->bindValue(1, '%' . $_GET['title'] . '%');
    $stm->bindValue(2, $_GET['type']);
    $stm->bindValue(3, $_GET['category']);
    $stm->execute();

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stm = $pdo->query("SELECT i.*, AVG(n.note) as moy FROM item as i INNER JOIN note as n ON i.id = n.item_id GROUP BY n.item_id");
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    //  var_dump($rows);
}


$stm = $pdo->query("SELECT id, name FROM category");

$categories = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <form method="get" class="col-md-6" autocomplete="off">
                        <div class="md-form mt-0">
                            <input class="form-control" id="autocomplete" type="text" name="title" placeholder="Search" aria-label="Search">
                            <select class="form-control" id="category" name="category">
                                <?php foreach ($categories as $c) { ?>
                                    <option value="<?=$c['id']?>"><?=$c['name']?></option>
                                <?php } ?>
                            </select>
                            <label>
                                <input type="radio" id="type1" name="type" value="0" checked>
                                serie
                            </label>
                            <label>
                                <input type="radio" id="type2" name="type" value="1">
                                movie
                            </label>
                            <button type="submit">Valider</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Note</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $r) { ?>
                            <tr>
                                <th scope="row"><?=$r['id']?></th>
                                <td><?=$r['title']?></td>
                                <td><?=($r['type']==0) ? 'serie' : 'movie'?></td>
                                <td><?=$r['description']?></td>
                                <td><?=$r['moy']?></td>
                                <td><a href="note.php?id=<?=$r['id']?>" class="btn btn-primary">Noter</a><a href="show.php?id=<?=$r['id']?>" class="btn btn-primary">Voir</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <p>
                        <a href="new.php" class="btn btn-primary">New</a>
                    </p>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');

?>