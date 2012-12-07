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
echo $form->open( URL::site('admin/news/update'));

echo $form->input(array(
    'name' => 'title',
    'label' => tr('Title'),
    'attr' => array( 'class' => 'span6' ),
    'info' => tr('Title')
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