<section class="forum py-4 d-flex flex-column">
    <div class="container py-4">
        <h1 class="h1-forum">Forum de discussion</h1>
        <form id="" class="d-flex row" method="POST">

            <div class="col-10 input-form-mon-compte d-flex">
                <svg width="16px" height="16px">
                    <image height="16px" fill="#DEC7B1" width="16px" href="./assets/images/loupe.svg" />
                </svg>
                <input class="input-form-mon-compte" placeholder="Recherchez une discussion" required type="text">
            </div>
            <button class="button2 col-2">Recherchez</button>
        </form>

        <div class="forum-input boite d-flex flex-column">
            <h4>Créer un topic</h4>
            <form method="POST">

                <?php 
                //     if (isset($errorMsg)) {
                //         echo '<p>' . $errorMsg . '</p>';
                // } elseif(isset($successMsg)) 
                ?>

                <div class="d-flex mb-3">
                    <input class="form-control" type="text" placeholder="Titre de votre question" name="title">
                </div>

                <div class="d-flex mb-3">
                    <textarea class="form-control" placeholder="Veuillez écrire ici" name="content"></textarea>
                </div>
                <button type="submit" name="validate" class="button2 button-form-forum">Enregister</button>
            </form>
            <?php

            if (isset($_POST['validate'])) {
                echo $_POST['title'];
                echo $_POST['content'];
                if (!empty($_POST['title']) and !empty($_POST["content"])) {

                    $question_title = htmlspecialchars($_POST['title']);
                    $question_text = nl2br(htmlspecialchars($_POST['content']));      // DataGrip -> MAKASINE_FORUM
                    $question_date = date('Y/m/d');
                    $question_id_author = 0;
                    $question_pseudo_author = "Silrine";

                    $connection = connectDB();
                    $insertQuestionWebsite = $connection->prepare('INSERT INTO MAKISINE_FORUM(question_title, question_text, question_date, question_id_author, question_pseudo_author)VALUES(?,?,?,?,?)');
                    $insertQuestionWebsite->execute(
                        array(
                            $question_title, 
                            $question_text, 
                            $question_date, 
                            $question_id_author, 
                            $question_pseudo_author
                        )
                    );

                    $successMsg = "Votre question a bien été publiée !";
                    echo $successMsg;

                } else {
                    $errorMsg = "Veuillez compléter tous les champs";
                    echo $errorMsg;
                }
            }
            ?>

        </div>

        <!-- 
        <div class="forum-input boite d-flex flex-column">
            <h4>Discussion</h4>
            <div class="d-flex mb-3">
                <input class="form-control" type="text" placeholder="Titre de votre question">
            </div>

            <div class="d-flex mb-3">
                <textarea class="form-control" placeholder="Veuillez écrire ici"></textarea>
            </div>
            <button type="submit" class="button2 button-form-forum" name="validate">Enregister</button>

        </div> -->

    </div>
</section>