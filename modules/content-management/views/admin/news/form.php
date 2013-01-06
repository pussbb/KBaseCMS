<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/news/update'));

echo $form->input(array(
    'name' => 'title',
    'label' => tr('Title'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->input(array(
    'name' => 'link',
    'label' => tr('Link'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->textarea(array(
    'name' => 'content',
    'label' => tr('Content'),
    'attr' => array( 'class' => 'span6'),
));

echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
