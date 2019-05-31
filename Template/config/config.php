<div class="panel">
    <?= $this->form->radio('unicode_shortcode', 'Oldschool Emojis' , 1, isset($values['unicode_shortcode'])&& $values['unicode_shortcode']==1) ?>
    <?= $this->form->radio('unicode_shortcode', 'Newschool Emojis ' , 2, isset($values['unicode_shortcode'])&& $values['unicode_shortcode']==2) ?>
</div>