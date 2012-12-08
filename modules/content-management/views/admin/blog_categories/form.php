<?php defined('SYSPATH') or die('No direct script access.');

$general = Arr::get($model->errors(), 'general');

if ( $general)
{
    echo '<div class="alert alert-error">
        <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">'.tr('Warning').'!</h4>
                '.$general.'
                </div>';
}

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));
echo $form->open( URL::site('admin/blog_categories/update'));

echo $form->input(array(
    'name' => 'name',
    'label' => tr('name'),
    'attr' => array( 'class' => 'span6' ),
));

echo $form->textarea(array(
    'name' => 'description',
    'label' => tr('Description'),
    'attr' => array( 'class' => 'span6'),
));
;

echo $form->select(array(
    'name' => 'parent_id',
    'label' => tr('Parent'),
    'attr' => array( 'class' => 'span6'),
),Collection::for_select(Model_Blog_Category::find_all()->records, 'name') );
echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
