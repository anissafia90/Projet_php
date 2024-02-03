<?php

require_once (__DIR__ . '/config/database.php');
require_once (__DIR__ . '/includes/header.php');

?>

    <main role="main">

        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <p>
                        <a href="src/user/logout.php" class="btn btn-success">Logout</a>
                    </p>
                    <?php } else {?>
                    <p>
                        <a href="src/user/new.php" class="btn btn-success">Créer un compte</a>
                    </p>
                    <p>
                        <a href="src/user/login.php" class="btn btn-primary">Login</a>
                    </p>
                    <?php } ?>
                    <p>
                        <a href="/Projet_php/src/item/random.php" class="btn btn-primary">Random</a>
                    </p>
                </div>
            </div>
        </div>

    </main>


<?php

require_once (__DIR__ . '/includes/footer.php');

?>