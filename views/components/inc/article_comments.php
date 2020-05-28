<section class="container_comments">

    <?php foreach($comments as $c): ?>

        <div class="comment_temp">

            <div class="comments_user_infos">

                <img src="<?=PATH.$c->avatar; ?>" alt="avatar" class="avatar">

                <strong><?=htmlspecialchars($c->username); ?></strong>

            </div>

            <div class="container_comment_content">

                <p><?=htmlspecialchars($c->comment_content); ?></p>

            </div>

            <div class="container_date">

                <em><?=$c->comment_date; ?></em>
                        
            </div>
                    
        </div>

    <?php endforeach; ?>
                

</section>