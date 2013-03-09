<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Blog_Categories {

    static public function tree_for_select($root_only = TRUE)
    {
        $tree = Collection::build_tree(Model_Blog_Category::find_all()->records);
        $result = array();
        foreach($tree as $item) {
            $object = $item['object'];

            $result[$object->id] = $object->name;
            if ($root_only)
                continue;

            if (Arr::get($item, 'childs'))
            {
                foreach(Arr::get($item, 'childs') as $child) {
                    $obj = $child['object'];
                    $result[$obj->id] = '&nbsp;&nbsp;&mdash;&nbsp;'.$obj->name;
                }
            }
        }
        return $result;
    }

}
