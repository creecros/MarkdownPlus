<div class="panel">
    <?= $this->form->radio('unicode_shortcode', 'Oldschool Emojis' , 1, isset($values['unicode_shortcode'])&& $values['unicode_shortcode']==1) ?>
    <?= $this->form->radio('unicode_shortcode', 'Newschool Emojis ' , 2, isset($values['unicode_shortcode'])&& $values['unicode_shortcode']==2) ?>
</div>
<div class="panel">
    <?= $this->form->radio('emoji_word_boundary', 'Replace :shortnames: anywhere' , 2, ! isset($values['emoji_word_boundary']) || $values['emoji_word_boundary']==2) ?>
    <?= $this->form->radio('emoji_word_boundary', 'Replace :shortnames: only at word boundaries (keeps MAC addresses and file:line:col references intact)' , 1, isset($values['emoji_word_boundary']) && $values['emoji_word_boundary']==1) ?>
</div>
