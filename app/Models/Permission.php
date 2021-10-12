<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission {

    public static function defaultPermissions() {
        $result = array();
        $modules = [
           "dashboards",
           "banks",
           "brands",
           "vehicles",
           "car_images",
           "car_penalties",
           "persons",
           "customer_contacts",
           "customer_files",
           "drivers",
           "fuels",
           "identities",
           "models",
           "services",
           "status",
           "orders",
           "purchases",
           "types",
           "reports",
           "roles",
           "settings",
           "users",
           "audits",
        ];
        asort($modules);
        $actions = ["view", "add", "edit", "delete"];
        foreach ($modules as $m) {
            foreach ($actions as $a) {
                $result[] = $a . "_" . $m;
            }
        }
        return $result;
    }

}
