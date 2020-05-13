<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MenuBar extends BaseModel
{

    protected $menu = [];

    const DASHBOARD_LINK = 'welcome';
    const LOGOUT_LINK = 'logout';

    const DEFAULT_MENU_ITEMS = [
        self::DASHBOARD_LINK,
        self::LOGOUT_LINK
    ];


    /**
     * MenuBar constructor.
     */
    public function __construct() {
    }



    /**
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }


}
