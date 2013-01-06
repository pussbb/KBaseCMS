<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $errors,
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/pages/update'.URL::query()));

$file = NULL;

if ( ! $page) {
    echo $form->input(array(
        'name' => 'filename',
        'label' => tr('Page name'),
        'attr' => array( 'class' => 'span6 page-uri' ),
    ));

}

if ($type === 'file') {
    echo $form->textarea(array(
        'name' => 'content',
        'value' => $page ? file_get_contents($page) : NULL,
        'label' => tr('Content'),
        'attr' => array( 'class' => 'input-xxlarge code', 'id' => 'code'),
    ));
}
else {
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
            $file = $page.DIRECTORY_SEPARATOR.$lang->code.'.php';
            echo $form->textarea(array(
                'name' => 'content['.$lang->code.']',
                'value' => file_exists($file) ? file_get_contents($file) : NULL,
                'label' => tr('Content'),
                'attr' => array( 'class' => 'input-xxlarge code'),
            ));
            echo '</div>';
        }
    echo '</div>';
}

echo $form->form_actions(array(
    'buttons' => array(
        array('submit', tr('Save'), array( 'class' => 'btn btn-primary', 'type' => 'submit'))
    )
));
echo $form->close();
