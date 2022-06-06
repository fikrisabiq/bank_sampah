<?php

namespace App\Validation;

use \App\Models\TunaiModel;

class CustomRules
{

    // Rule is to validate mobile number digits
    public function checktunai(string $str, ?string &$error = null): bool
    {
        $tunai = new TunaiModel();
        $tunai = $tunai->getTunai(user_id())['tunai'];
        if ((int) $str > $tunai) {
            $error = 'tunai tidak boleh melebihi yang dimiliki';

            return false;
        }

        return true;
    }
}
