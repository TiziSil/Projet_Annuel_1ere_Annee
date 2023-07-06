
<section class="forum py-5 d-flex flex-column">
    <div class="container py-5">
        <h1 class="h1-forum">Forum de discussion</h1>


        <div class="forum-input boite d-flex flex-column">
            <h4>Créer un topic</h4>
            <form action="./core/forumAddTopic.php" method="POST">
                <div class="d-flex mb-3">
                    <input class="form-control" type="text" placeholder="Titre de votre question" name="title">
                </div>

                <div class="d-flex mb-3">
                    <textarea class="form-control" placeholder="Veuillez écrire ici" name="content"></textarea>
                </div>
                <button type="submit" <?php if (!isConnected()) {
                    echo 'disabled';
                } ?> name="validate"
                    class="button2 button-form-forum">Enregister</button>
                <p class="error-non-connecter">
                    <?php if (!isConnected()) {
                        echo 'Merci de vous connecter pour créer un Topic !';
                    } ?>
                </p>
            </form>
        </div>

    </div>
</section>

<section class="forum-section-2 py-4 d-flex flex-column">
    <div class="container py-5 ">
        <div clas="boite d-flex flex-column">
            <form class="d-flex flex-row boite" method="POST">
                <div class="col-8 barre-de-recherche-topic d-flex">
                    <svg width="16px" height="16px">
                        <image height="16px" fill="#DEC7B1" width="16px" href="./assets/images/loupe.svg" />
                    </svg>
                    <input class="barre-de-recherche-topic" placeholder="Recherchez une discussion" required type="text"
                        name="recherche">
                </div>
                <button class="button2 col-2 mx-1">Recherchez</button>
                <a href="./forum" class="button2 col-2">Supprimer critère</a>
            </form>
        </div>
        <div class="forum-input boite d-flex flex-column">

            <?php
            $connection = connectDB();

            if (isset($_POST['recherche'])) {
                $getAllMyQuestions = $connection->prepare('SELECT question_id, question_title, question_text, question_supprimer, question_id_author FROM MAKISINE_FORUM WHERE question_title LIKE ? ORDER BY question_id DESC');
                $getAllMyQuestions->execute(array($_POST['recherche']));
            } else {
                $getAllMyQuestions = $connection->prepare('SELECT question_id, question_title, question_text, question_supprimer, question_id_author FROM MAKISINE_FORUM ORDER BY question_id DESC');
                $getAllMyQuestions->execute();
            }


            while ($question = $getAllMyQuestions->fetch()) {
                if ($question['question_supprimer'] === 0) { ?>
                    <div class="card d-flex my-1">
                        <div class="card-header d-flex flex-row justify-content-between">
                            <h5 class="d-flex">
                                <?php echo $question['question_title']; ?>
                            </h5>

                            <p class="card-text liste-text-forum d-flex">
                                <?php echo $question['question_text']; ?>
                            </p>

                            <div class="buttons-liste-forum">
                                <?php echo '<a href="./forum-article?id=' . $question['question_id'] . '" class="button3">Accéder à l\'article</a>'; ?>
                                <?php if (isset($_SESSION['id_utilisateur']) and $_SESSION['id_utilisateur'] === $question['question_id_author']) { ?>
                                    <a href="#" class="button3">Modifier l'article</a>
                                    <a href="#" class="button3">Supprimer mon article</a>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </div>
</section>