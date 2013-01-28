<?php defined('SYSPATH') or die('No direct script access.');

echo '<section class="add-comment">';

echo '<h3>'.tr('Add comment').'</h3>';

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('blog/comments/update'));

echo $form->textarea(array(
    'name' => 'content',
    'value' => Object::property($model, 'content'),
    'attr' => array( 'class' => 'input-xxlarge'),
));

echo $form->hidden('post_id', Object::property($model, 'post_id'));

echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Add'), array( 'class' => 'btn btn-primary pull-right', 'type' => 'submit'))
    )
));
echo $form->close();

echo '</section>';
