<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');

$stm = $pdo->prepare("SELECT i.*, AVG(n.note) as moy FROM item as i INNER JOIN note as n ON i.id = n.item_id WHERE i.id = ? GROUP BY n.item_id");
$stm->bindValue(1, $_GET['id']);
$stm->execute();
$r = $stm->fetch(PDO::FETCH_ASSOC);

$stm = $pdo->prepare("SELECT n.*, u.email FROM note as n INNER JOIN user as u ON n.user_id = u.id WHERE item_id = ?");
$stm->bindValue(1, $_GET['id']);
$stm->execute();
$comments = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
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
                            <tr>
                                <th scope="row"><?=$r['id']?></th>
                                <td><?=$r['title']?></td>
                                <td><?=($r['type']==0) ? 'serie' : 'movie'?></td>
                                <td><?=$r['description']?></td>
                                <td><?=$r['moy']?></td>
                                <td><a href="/src/item/note.php?id=<?=$r['id']?>" class="btn btn-primary">Noter</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h3>Comments</h3>
                <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($comments as $c) { ?>
                        <tr>
                            <td><?=$c['email']?></td>
                            <td><?=$c['comment']?></td>
                            <td><?=$c['note']?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');

?>