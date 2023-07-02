<?php if (isset($_GET['id']) and !empty($_GET['id'])) {
    $connection = connectDB();

    $getQuestion = $connection->prepare('SELECT question_id, question_title, question_text, question_id_author, question_pseudo_author, question_date FROM MAKISINE_FORUM WHERE question_id = ?');
    $getQuestion->execute(array($_GET['id']));
    $question = $getQuestion->fetch();

    $getReponses = $connection->prepare('SELECT reponse_id_author, reponse_id_question, reponse_date, reponse_pseudo_author, reponse_text FROM MAKISINE_FORUM_REPONSE WHERE reponse_id_question = ? ORDER BY reponse_id ASC');
    $getReponses->execute(array($_GET['id']));
    
?>
    <section class="forum-section-2 py-4 d-flex flex-column">
        <div class="container py-5">
            <!-- Question initiale -->
            <div class="boite">
                <div class="d-flex flex-row justify-content-between">
                    <h4>
                        <?php echo $question['question_title']; ?> - <?php echo $question['question_pseudo_author']; ?>
                    </h4>
                    <p><?php echo $question['question_date']?></p>
                </div>
                <p>
                    <?php echo $question['question_text']; ?>
                </p>
            </div>

            <?php while($reponse = $getReponses->fetch()) {?>
                <div class="boite py-2 my-2">
                    <div class="d-flex flex-row justify-content-between">
                        <h4>
                            <?php echo $reponse['reponse_pseudo_author']; ?>
                        </h4>
                        <p><?php echo $reponse['reponse_date']?></p>
                    </div>
                    <p>
                        <?php echo $reponse['reponse_text']; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </section>

    <section class="forum-section-2 py-2 d-flex flex-column">
        <div class="container py-5">
            <!-- Champ de réponse du topic -->
            <div class="boite d-flex flex-column">
                <form action="./core/repondreTopicForum.php" method="POST">
                    <input style="display:none;" name="id" value="<?php echo $_GET['id'] ?>">
                    <div class="d-flex mb-3"><textarea class="form-control" placeholder="Répondre" name="reponse"></textarea></div>
                    <button type="submit" class="button2 button-form-forum">Envoyer</button>
                </form>
            </div>
        </div>
    </section>

<?php } ?>