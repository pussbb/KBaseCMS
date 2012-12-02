<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Actions {

    public static function action($model, $action, $attr = array())
    {
        switch($action){
            case 'destroy':
                return self::destroy($model, $attr);
                break;
            case 'new':
            case 'create':
                return self::create($model, $attr);
                break;
            case 'edit':
                return self::create($model, $attr);
                break;
            case 'view':
            case 'details':
                return self::details($model, $attr);
                break;
            default:
                return HTML::anchor(Helper_Model::url($model, $action), $action, array('class' => 'action action_'.$action));
                break;
        }
    }

    public static function destroy($model, $attr = array())
    {
        $attr = self::append_class($attr, 'action action_destroy');
        return HTML::anchor(
            Helper_Model::url($model, 'destroy'),
           '<i class="icon-trash"></i> '. tr('Delete'),
            array_merge(array(
                'data-title' => tr('Delete %s', array($model->representative_name())),
                'data-toggle'=>'confirm',
                'title' => tr('Delete %s', array($model->representative_name()))
            ), $attr)
        );
    }

    private static function append_class(array $attr, $class)
    {
        if (isset($attr['class']))
            $attr['class'] = $attr['class'].' '. $class;
        return $attr;
    }

    public static function create($model, $attr = array())
    {
        $attr = self::append_class($attr, 'action action_new');
        return HTML::anchor(
            Helper_Model::url($model, 'new'),
           '<i class="icon-magic"></i> '. tr('Add new %s', array($model->representative_name())),
            array_merge(array(
                'title' => tr('Add new %s', array($model->representative_name()))
            ), $attr)
        );
    }

    public static function edit($model, $attr = array())
    {
        $attr = self::append_class($attr, 'action action_edit');
        return HTML::anchor(
            Helper_Model::url($model, 'edit'),
           '<i class="icon-pencil"></i> '. tr('Edit %s', array($model->representative_name())),
            array_merge(array(
                'title' => tr('Edit %s', array($model->representative_name()))
            ), $attr)
        );
    }

    public static function details($model, $attr = array())
    {
        $attr = self::append_class($attr, 'action action_details');
        return HTML::anchor(
            Helper_Model::url($model, 'details'),
           '<i class="icon-info-sign"></i> '. tr('View %s details', array($model->representative_name())),
            array_merge(array(
                'title' => tr('View %s details', array($model->representative_name()))
            ), $attr)
        );
    }
}
