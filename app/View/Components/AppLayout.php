<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // return view('layouts.app');
        $isAdminRoute = preg_match('/^admin\//', request()->path());
        $layout = $isAdminRoute ? 'admin.layouts.app' : 'layouts.app';
        
        return view($layout);
    }
}
