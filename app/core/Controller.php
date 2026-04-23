<?php

class Controller
{
    public function view($view, $data = [], $useLayout = true)
    {
        extract($data);

        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';

        // 🔥 kalau tidak pakai layout
        if (!$useLayout) {
            require $viewFile;
            return;
        }

        // 🔥 auto detect layout
        if (strpos($view, 'admin/') === 0) {
            require BASE_PATH . '/app/views/admin/layouts/main.php';
        } else {
            require BASE_PATH . '/app/views/user/layouts/main.php';
        }
    }
}
