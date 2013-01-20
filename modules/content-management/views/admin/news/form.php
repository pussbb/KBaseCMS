<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/news/update'));

echo $form->input(array(
    'name' => 'title',
    'value' => Object::property($model, 'title'),
    'label' => tr('Title'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->input(array(
    'name' => 'link',
    'value' => Object::property($model, 'link'),
    'label' => tr('Link'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->textarea(array(
    'name' => 'content',
    'value' => Object::property($model, 'content'),
    'label' => tr('Content'),
    'attr' => array( 'class' => 'span6 editor'),
));

echo $form->hidden('id', Object::property($model, 'id'));

echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
