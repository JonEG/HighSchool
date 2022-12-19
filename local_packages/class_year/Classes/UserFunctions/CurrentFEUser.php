<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\UserFunctions;

class CurrentFEUser
{

    public function getFEUsername(string $content, array $conf)
    {
        $user = $GLOBALS['TSFE']->fe_user->user;
        if (!empty($user)) {
            return $user['name'] . ' ' . $user['last_name'];

        } else {
            return '';
        }
    }
}
