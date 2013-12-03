

<div class="content">
    <div class="block list">
        <ol>
            <?php foreach($articles as $article): ?><li>
                <a href="index.php?show=<?php echo $article->getArticleId(); ?>">
                    <div class="square-thumb" style="background-image: url(<?php echo $article->getArticleImage(); ?>);"></div>
                    <h4>[<?php echo $article->getArticleType(); ?>] <?php echo $article->getArticleTitle(); ?></h4>
                    <small>author(s): [  ]</small>
                    <small>date posted: [ <?php echo date("l jS", $article->getArticleTimestamp()); ?> ]</small>
                    <small>likes: [ <?php echo $this->model->getLikes( $article->getArticleId() ); ?> ]</small>
                    <small>dislikes: [ <?php echo $this->model->getDislikes( $article->getArticleId() ); ?> ]</small>
                    <small>tags: [  ]</small>
                </a>

                <a class="pull-right" href="index.php?edit=<?php echo $article->getArticleId(); ?>">
                    <button>edit</button>
                </a>

                <form class="pull-right" action="?page=articles&action=delete_article" method="post">
                    <input type='hidden' name='action' value='delete' />
                    <input type='hidden' name='article_id' value='<?php echo $article->getArticleId(); ?>' />
                    <button onclick="this.form.submit(); return false;">delete</button>
                </form>

                <form class="pull-right" action="?page=articles&action=change_article_status" method="post">
                    <input type='hidden' name='article_id' value='<?php echo $article->getArticleId(); ?>' />
                    <select onchange="this.form.submit();" name="article_status">
                        <option <?php echo ($article->getArticleStatus()=='submitted')?'selected':'' ?> value="submitted" name='submitted'>submitted</option>
                        <option <?php echo ($article->getArticleStatus()=='under_review')?'selected':'' ?> value="under_review" name='under_review'>under_review</option>
                        <option <?php echo ($article->getArticleStatus()=='awaiting_changes')?'selected':'' ?> value="awaiting_changes" name='awaiting_changes'>awaiting_changes</option>
                        <option <?php echo ($article->getArticleStatus()=='published')?'selected':'' ?> value="published" name='published'>published</option>
                        <option <?php echo ($article->getArticleStatus()=='rejected')?'selected':'' ?> value="rejected" name='rejected'>rejected</option>
                    </select>
                </form>

            </li><?php endforeach; ?>
        </ol>
    </div>
</div>