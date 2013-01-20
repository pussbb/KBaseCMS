<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/blog_categories/update'));

echo $form->input(array(
    'name' => 'name',
    'value' => Object::property($model, 'name'),
    'label' => tr('name'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->textarea(array(
    'name' => 'description',
    'value' => Object::property($model, 'description'),
    'label' => tr('Description'),
    'attr' => array( 'class' => 'span6'),
));

$categories = Collection::for_select(Model_Blog_Category::find_all()->records, 'name') ;
Arr::unshift($categories, NULL, tr('No parent'));

echo $form->select(array(
    'name' => 'parent_id',
    'label' => tr('Parent'),
    'value' => Object::property($model, 'parent_id'),
    'attr' => array( 'class' => 'span6'),
    'buttons' => $categories
));

echo $form->hidden('id', Object::property($model, 'id'));

echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
