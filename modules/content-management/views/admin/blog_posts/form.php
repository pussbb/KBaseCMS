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

$content = Object::property($model, 'contents');
$contents = array();
if ($content) {
    for($i = 0; $i < count($content); $i++) {
        $item = $content[$i];
        $contents[$item->language_id] = $item;
    }
}

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
            $post = Arr::get($contents, $lang->id, array());
            if ($post) {
                $post = $post->as_array();
            }
            echo $form->input(array(
                'name' => "post[$lang->id][title]",
                'value' => Arr::get($post, 'title'),
                'label' => tr('Title'),
                'attr' => array( 'class' => 'span6' ),
            ));
            echo $form->input(array(
                'name' => "post[$lang->id][keywords]",
                'value' => Arr::get($post, 'keywords'),
                'label' => tr('Keywords'),
                'attr' => array( 'class' => 'span6' ),
            ));
            echo $form->textarea(array(
                'name' => "post[$lang->id][content]",
                'value' => Arr::get($post, 'content'),
                'attr' => array( 'class' => 'editor'),
            ));
            echo $form->hidden("post[$lang->id][id]", Arr::get($post, 'id'));
        echo '</div>';
    }

echo $form->hidden("id", Object::property($model, 'id'));
echo '</div>';
?>

<?php
echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
