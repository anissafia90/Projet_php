<?php

require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../includes/header.php');

$rows = [];

$stm = $pdo->query("SELECT i.*, AVG(n.note) as moy FROM item as i INNER JOIN note as n ON i.id = n.item_id GROUP BY n.item_id ORDER BY RAND() LIMIT 1");
$r = $stm->fetch(PDO::FETCH_ASSOC);

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
                                <td><a href="note.php?id=<?=$r['id']?>" class="btn btn-primary">Noter</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/../../includes/footer.php');

?>