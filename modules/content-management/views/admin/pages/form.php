<?php defined('SYSPATH') or die('No direct script access.');
?>
   <script>
/*CodeMirror.commands.autocomplete = function(cm) {
    CodeMirror.simpleHint(cm, CodeMirror.javascriptHint);
}*/
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        mode: 'php',
        theme: 'monokai',
        autoCloseTags: true,
        lineWrapping: true,
        extraKeys: {"Ctrl-Space": "autocomplete"}
      });
</script>
<?php
$form = new Pretty_Form(array(
    'template' => 'twitter_bootstrap',
));

echo $form->open( URL::site('admin/pages/update'.URL::query()));

$file = NULL;

if ( ! $page) {
    echo $form->input(array(
        'name' => 'name',
        'label' => tr('name'),
        'attr' => array( 'class' => 'span6' ),
    ));

}

if ($type === 'file') {
    echo $form->textarea(array(
        'name' => 'file',
        'value' => $page ? file_get_contents($page) : NULL,
        'label' => tr('Content'),
        'attr' => array( 'class' => 'span6 code', 'id' => 'code'),
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
                'name' => 'file['.$lang->code.']',
                'value' => file_exists($file) ? file_get_contents($file) : NULL,
                'label' => tr('Content'),
                'attr' => array( 'class' => 'inputxxxxlarge code'),
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
