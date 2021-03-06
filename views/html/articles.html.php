<div class="content">
    <div class="block list <?php if ( $_GET['type']=='basic') { echo 'basic-layout'; } else if ( $_GET['type']=='column') { echo 'column-layout'; } else if ( $_GET['type']=='review') { echo 'review-layout'; }  ?> ">
        <ol>
            <?php foreach($articles as $article): ?>
                <?php $article_authors = $this->articlesModel->getArticleAuthors( $article->getArticleId() ); ?>
                <?php $article_editors = $this->articlesModel->getArticleEditors( $article->getArticleId() ); ?>
                <?php if ($article->getArticleStatus()=='published') { ?>
                <li>
                <a href="index.php?show=<?php echo $article->getArticleId(); ?>">
                    <div class="square-thumb" style="background-image: url(<?php echo $article->getArticleImage(); ?>);"></div>
                    <h4>
                    	<?php if ($article->getArticleType() == "review_article") {
                    			echo "<small class='bubble'>review</small>";
                    		  } else if ($article->getArticleType() == "basic_article") {
                    			echo "<small class='bubble'>article</small>";
                    		  } else if ($article->getArticleType() == "column_article") {
                    			echo "<small class='bubble'>column</small>";
                    		  }
                    	?>
                    	<?php echo $article->getArticleTitle(); ?>
                    </h4>
                    <small>author(s): [
                        <?php foreach($article_authors as $author): ?>
                            <?php print $author['user_name']; ?> |
                        <?php endforeach; ?>
                        ]
                    </small>
                    <small>editors(s): [
                        <?php foreach($article_editors as $editor): ?>
                            <?php print $editor['user_name']; ?> |
                        <?php endforeach; ?>
                        ]
                    </small><br/>
                    <small>date posted: [ <?php echo date("G:i l jS", $article->getArticleTimestamp()); ?> ]</small><br/>
                    <small>likes: [ <?php echo $this->articlesModel->getLikes( $article->getArticleId() ); ?> ]</small>
                    <small>dislikes: [ <?php echo $this->articlesModel->getDislikes( $article->getArticleId() ); ?> ]</small>
                    <?php if( $article->getArticleType() == "review_article" ) { ?><small>rating: [<?php echo $this->articlesModel->getArticleRating( $article->getArticleId() ); ?>]</small><?php } ?>
                    <?php if( $article->getArticleType() == "column_article" ) { ?><small>column: [<?php echo $this->articlesModel->getArticleColumn( $article->getArticleId() ); ?>]</small><?php } ?>
                    <?php if( $article->getStaffPickedArticle() == 1 ) { ?><small>STAFF PICK</small><?php } ?>
                </a>

                <?php if ( $_GET["type"]=="all") { ?>
                <?php if( isset($_SESSION['user_role']) ) {
                    if ( $_SESSION['user_role']=="writer" || $_SESSION['user_role']=="editor" || $_SESSION['user_role']=="publisher" ) { ?>

                    <?php $article_authors = $this->articlesModel->getArticleAuthors( $article->getArticleId() ); ?>
                <?php
                    if ( $_SESSION['user_role']=="writer") {
                        foreach ($article_authors as $author) {
                                if ( $author["user_name"] == $_SESSION['user_name'] ) { ?>
                        <a class="pull-right" href="?page=edit&id=<?php echo $article->getArticleId(); ?>">
                            <button>edit</button>
                        </a>
                    <?php }}} else { ?>
                        <a class="pull-right" href="?page=edit&id=<?php echo $article->getArticleId(); ?>">
                        <button>edit</button>
                    </a>
                    <?php } ?>
                    <?php if ( $_SESSION['user_role']=="publisher" ) { ?>
                        <form class="pull-right" action="?page=articles&type=all&action=delete_article" method="post">
                            <input type='hidden' name='action' value='delete' />
                            <input type='hidden' name='article_id' value='<?php echo $article->getArticleId(); ?>' />
                            <button onclick="this.form.submit(); return false;">delete</button>
                        </form>
                    <?php } ?>
                    <?php if ( $_SESSION['user_role']=="editor" || $_SESSION['user_role']=="publisher" ) { ?>
                        <form class="pull-right" action="?page=articles&type=all&action=change_article_status" method="post">
                            <input type='hidden' name='article_id' value='<?php echo $article->getArticleId(); ?>' />
                            <select onchange="this.form.submit();" name="article_status">
                                <option <?php echo ($article->getArticleStatus()=='submitted')?'selected':'' ?> value="submitted" name='submitted'>submitted</option>
                                <option <?php echo ($article->getArticleStatus()=='under_review')?'selected':'' ?> value="under_review" name='under_review'>under_review</option>
                                <option <?php echo ($article->getArticleStatus()=='awaiting_changes')?'selected':'' ?> value="awaiting_changes" name='awaiting_changes'>awaiting_changes</option>
                                <option <?php echo ($article->getArticleStatus()=='published')?'selected':'' ?> value="published" name='published'>published</option>
                                <option <?php echo ($article->getArticleStatus()=='rejected')?'selected':'' ?> value="rejected" name='rejected'>rejected</option>
                            </select>
                        </form>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
            </li>
            <?php } ?>
        <?php endforeach; ?>
        </ol>
    </div>
</div>