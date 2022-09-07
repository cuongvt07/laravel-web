<?php


namespace App\Components;

use App\Models\Menu;


class MenuRecusive
{
    private $html;

    public function  __construct()
    {
        $this->html = '';
    }


    public function menuRecusiveAdd($parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            $this->html .= "<option  value='" . $dataItem->id . "'>"   . $dataItem->name . "</option>";
            $this->menuRecusiveAdd($dataItem->id, $subMark  . '--');
        }

        return $this->html;
    }


    public function menuRecusiveEdit($parentIdMenuEdit, $parentId=0, $id = 0)
    {
        $data = Menu::where('parent_id', $parentId)->get();
                foreach ($data as $dataItem) {
            if ($parentIdMenuEdit == $dataItem->id) {
                $this->html .= "<option selected value='" . $dataItem->id . "'>"   . $dataItem->name . "</option>";
            } else {
                $this->html .= "<option  value='" . $dataItem->id . "'>"   . $dataItem->name . "</option>";
            }
            $this->menuRecusiveEdit($parentIdMenuEdit, $dataItem->id);
        }
        return $this->html;
    }
}
