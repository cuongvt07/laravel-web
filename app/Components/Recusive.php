<?php

namespace App\Components;

use App\Models\Category;
use App\Http\Controllers;

class Recusive
{

    private $data;
    private $tag = '';

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function categoryRe($parentId, $id = 0)
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->tag .= "<option selected value='" . $value['id'] . "'>"   . $value['name'] . "</option>";
                } else {
                    $this->tag .= "<option  value='" . $value['id'] . "'>"   . $value['name'] . "</option>";
                }
                $this->categoryRe($parentId, $value['id']);
            }
        }
        return $this->tag;
    }

    public function categoryRecustive($id = 0)
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                $this->tag .= "<option  value='" . $value['id'] . "'>"   . $value['name'] . "</option>";

                $this->categoryRecustive($value['id']);
            }
        }
        return $this->tag;
    }
}
