<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestNetVarCmp extends Component
{
    /**
     * Create a new component instance.
     */

    public $dashboard;
    public $account;
    public $contacts;
    public $setting;
    public $about;
    public $home;
    public $menu_lists ;

    public function __construct($home=0,$dashboard=1,$account=0,$contacts=0,$setting=0,$about=0,$menu_list="")
    {
        $this->home = intval($home);
        $this->dashboard = intval($dashboard);
        $this->account = intval($account);
        $this->contacts = intval($contacts);
        $this->setting = intval($setting);
        $this->about = intval($about);
        $this->menu_lists = $menu_list;
        
    }

   


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.test-net-var-cmp');
    }
}
