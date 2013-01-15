<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $model->errors(),
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/blog_posts/update'));

echo $form->input(array(
    'name' => 'uri',
    'value' => Object::property($model, 'uri'),
    'label' => tr('Uri'),
    'attr' => array( 'class' => 'span6 page-uri' ),
));

$categories = Collection::for_select(Model_Blog_Category::find_all()->records, 'name') ;

echo $form->select(array(
    'name' => 'category_id',
    'value' => Object::property($model, 'category_id'),
    'label' => tr('Category'),
    'attr' => array( 'class' => 'span6'),
    'buttons' => $categories
));

$content = Object::property($model, 'contents', array());

$langs = Model_Language::find_all()->records;
echo '<ul class="nav nav-tabs" >';
    foreach($langs as $lang)
    {
        echo '<li>';
            echo HTML::anchor('#'.$lang->code, $lang->name);
        echo '</li>';
    }
echo '</ul>';
echo '<div class="tab-content">';
    foreach($langs as $lang) {
        echo '<div class="tab-pane" id="'.$lang->code.'">';
            echo $form->input(array(
                'name' => "post[$lang->id][title]",
                'label' => tr('Title'),
                'attr' => array( 'class' => 'span6' ),
            ));
            echo $form->input(array(
                'name' => "post[$lang->id][keywords]",
                'label' => tr('Keywords'),
                'attr' => array( 'class' => 'span6' ),
            ));
            echo $form->textarea(array(
                'name' => "post[$lang->id][content]",
                'attr' => array( 'class' => 'editor'),
            ));

        echo '</div>';
    }

echo '</div>';
?>

<?php
echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
