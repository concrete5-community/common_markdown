<?php 
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">
    <div class="input">
        <?php 
        echo $form->textarea('content', $content, array('style' => 'min-height: 380px'));
        ?>
    </div>
</div>


<div class="form-group">
    <div class="input">
        <label>
            <?php 
            echo $form->checkbox('inlineHTML', 1, $inlineHTML)." ";
            echo t("Allow HTML");
            ?>
        </label>
    </div>
</div>

<p>
    <?php  echo t('Markdown reference: <a href="%1$s" target="_blank">%1$s</a>', 'http://commonmark.org/help/'); ?>
</p>