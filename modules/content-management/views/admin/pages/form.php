<?php defined('SYSPATH') or die('No direct script access.');

$form = new Pretty_Form(array(
    'errors' => $errors,
    'template' => 'twitter_bootstrap',
));

echo $form->general_error();
echo $form->open( URL::site('admin/pages/update'.URL::query()));

$file = NULL;

if ( ! $absoluteFilePath) {
    echo $form->input(array(
        'name' => 'filename',
        'value' => $page,
        'label' => tr('Page name'),
        'attr' => array( 'class' => 'span6 page-uri' ),
    ));
}

echo $form->hidden('type', $type);

if ($type === 'file') {
    echo $form->input(array(
        'name' => 'title',
        'value' => Arr::path($pages_config, $page.'.title', Arr::get($_REQUEST, 'title')),
        'label' => tr('Title'),
        'attr' => array( 'class' => 'input-xxlarge ' ),
    ));
    echo $form->input(array(
        'name' => 'keywords',
        'value' => Arr::path($pages_config, $page.'.keywords', Arr::get($_REQUEST, 'keywords')),
        'label' => tr('Keywords'),
        'attr' => array( 'class' => 'input-xxlarge ' ),
    ));
    echo $form->input(array(
        'name' => 'description',
        'value' => Arr::path($pages_config, $page.'.description', Arr::get($_REQUEST, 'description')),
        'label' => tr('Description'),
        'attr' => array( 'class' => 'input-xxlarge ' ),
    ));
    echo $form->textarea(array(
        'name' => 'content',
        'value' => $absoluteFilePath ? file_get_contents($absoluteFilePath) : NULL,
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
            echo $form->input(array(
                'name' => 'title['.$lang->code.']',
                'value' => Arr::path($pages_config, $page.'.'.$lang->code.'.title', Arr::path($_REQUEST, 'title.'.$lang->code)),
                'label' => tr('Title'),
                'attr' => array( 'class' => 'input-xxlarge ' ),
            ));
            echo $form->input(array(
                'name' => 'keywords['.$lang->code.']',
                'value' => Arr::path($pages_config, $page.'.'.$lang->code.'.keywords', Arr::path($_REQUEST, 'keywords.'.$lang->code)),
                'label' => tr('Keywords'),
                'attr' => array( 'class' => 'input-xxlarge ' ),
            ));
            echo $form->input(array(
                'name' => 'description['.$lang->code.']',
                'value' => Arr::path($pages_config, $page.'.'.$lang->code.'.description', Arr::path($_REQUEST, 'description.'.$lang->code)),
                'label' => tr('Description'),
                'attr' => array( 'class' => 'input-xxlarge ' ),
            ));
            $file = $absoluteFilePath.DIRECTORY_SEPARATOR.$lang->code.'.php';
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
