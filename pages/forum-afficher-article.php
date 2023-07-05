<?php if (isset($_GET['id']) and !empty($_GET['id'])) {

    $connection = connectDB();

    $getQuestion = $connection->prepare('SELECT question_id, question_title, question_text, question_id_author, question_pseudo_author, question_date, question_supprimer FROM MAKISINE_FORUM WHERE question_id = ?');
    $getQuestion->execute(array($_GET['id']));
    $question = $getQuestion->fetch();

    if ($question['question_supprimer'] === 0) {
        $getReponses = $connection->prepare('SELECT reponse_id, reponse_supprimer, reponse_id_author, reponse_id_question, reponse_date, reponse_pseudo_author, reponse_text FROM MAKISINE_FORUM_REPONSE WHERE reponse_id_question = ? ORDER BY reponse_id ASC');
        $getReponses->execute(array($_GET['id']));
    }

    ?>
    <section class="forum-section-2 py-4 d-flex flex-column">
        <div class="container py-5">
            <!-- Question initiale -->
            <form action="core/forumModifierTopic.php" method="POST" class="boite" id="<?php echo 'forum-topic-' . $question['question_id'] ?>">
                <div class="d-flex flex-row justify-content-between">
                    <h4>
                        <?php echo $question['question_title']; ?> -
                        <?php echo $question['question_pseudo_author']; ?>
                    </h4>
                    <div class="d-flex flex-row">
                        <p>
                            <?php echo $question['question_date'] ?>
                        </p>
                        <?php if (isset($_SESSION['id_utilisateur']) and $_SESSION['id_utilisateur'] === $question['question_id_author']) { ?>
                            <a href="#" onclick="activerModeEditionReponseForum('<?php echo 'forum-topic-' . $question['question_id'] ?>')">
                                <svg class="d-block my-1 mx-1" width="16px" height="16px">
                                    <image height="16px" width="16px" href="./assets/images/edit-solid.svg" />
                                </svg>
                            </a>
                            <a href="#">
                                <svg class="d-block my-1 mx-1" width="16px" height="16px">
                                    <image height="16px" width="16px" href="./assets/images/trash-solid.svg" />
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="forum-edition-cacher flex-column">
                    <input name="idQuestion" style="display: none"  value="<?php echo $question['question_id']; ?>" />
                    <textarea name="textQuestion" class="d-flex my-1"><?php echo $question['question_text']; ?></textarea>
                    <button class="button2">Enregistrer</button>
                </div>
                <div class="forum-edition-afficher">
                    <p>
                        <?php echo $question['question_text']; ?>
                    </p>
                </div>

            </form>

            <?php while ($reponse = $getReponses->fetch()) {
                if ($reponse['reponse_supprimer'] === 0) { ?>
                    <form action="core/forumModifierReponse.php" method="POST" class="boite py-2 my-2" id="<?php echo 'forum-reponse-' . $reponse['reponse_id'] ?>">
                        <div class="d-flex flex-row justify-content-between">
                            <h4>
                                <?php echo $reponse['reponse_pseudo_author']; ?>
                            </h4>
                            <div class="d-flex flex-row">
                                <p>
                                    <?php echo $reponse['reponse_date'] ?>
                                </p>
                                <?php if (isset($_SESSION['id_utilisateur']) and $_SESSION['id_utilisateur'] === $reponse['reponse_id_author']) { ?>
                                    <a href="#"onclick="activerModeEditionReponseForum('<?php echo 'forum-reponse-' . $reponse['reponse_id'] ?>')">
                                        <svg class="d-block my-1 mx-1" width="16px" height="16px">
                                            <image height="16px" width="16px" href="./assets/images/edit-solid.svg" />
                                        </svg>
                                    </a>
                                    <a href="#" onclick="suppresionMessage(<?php echo $reponse['reponse_id'] ?>)" href="#">
                                        <svg class="d-block my-1 mx-1" width="16px" height="16px">
                                            <image height="16px" width="16px" href="./assets/images/trash-solid.svg" />
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="forum-edition-cacher flex-column">
                            <input style="display: none" name="idReponse" value="<?php echo $reponse['reponse_id']; ?>" />
                            <textarea name="reponse_text" class="d-flex my-1"><?php echo $reponse['reponse_text']; ?></textarea>
                            <button class="button2">Enregistrer</button>
                        </div>
                        <div class="forum-edition-afficher">
                            <p>
                                <?php echo $reponse['reponse_text']; ?>
                            </p>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="boite py-2 my-2">
                        Ce message a été supprimer
                    </div>
                <?php }
            } ?>
        </div>
    </section>


    <section class="forum-section-2 py-2 d-flex flex-column">
        <div class="container py-5">
            <!-- Champ de réponse du topic -->
            <div class="boite d-flex flex-column">
                <form action="./core/repondreTopicForum.php" method="POST">
                    <input style="display:none;" name="id" value="<?php echo $_GET['id'] ?>">
                    <div <?php if (!isset($_SESSION['id_utilisateur'])) {
                        echo 'disabled';
                    } ?> class="d-flex mb-3">
                        <textarea class="form-control" placeholder="Répondre" name="reponse"></textarea>
                    </div>
                    <button <?php if (!isset($_SESSION['id_utilisateur'])) {
                        echo 'disabled';
                    } ?> type="submit"
                        class="button2 button-form-forum">Envoyer</button>
                </form>
                <p class="error-non-connecter">
                    <?php if (!isConnected()) {
                        echo 'Merci de vous connecter pour répondre à un topic !';
                    } ?>
                </p>
            </div>
        </div>
    </section>

<?php } ?>


<!-- Modale confirmation suppression réponse -->
<div id="modale-suppression" class="py-5">
    <div class="container py-5 my-5 ">
        <div class="my-5 d-flex flex-row justify-content-center">
            <div class="my-5 boite col-sm-8 col-12 col-lg-6 d-flex flex-column">
                <H4>Êtes-vous sur de vouloir supprimer votre message ?</H4>
                <div class="d-flex flex-row my-2 ">
                    <button class="flex-fill mx-1 button2" onclick="confirmerSuppressionMessage()">Supprimer</button>
                    <button class="flex-fill mx-1 button2" onclick="fermerModaleSuppresion()">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</div>