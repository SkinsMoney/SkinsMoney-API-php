<?php

/**
 * Created with love by: Patryk Vizauer (wizjoner.dev)
 * Date: 28.03.2023 16:50
 */

namespace SkinsMoney;

use SkinsMoney\Exceptions\SkinsMoneyException;

class Currencies extends Action
{
    public function get(): object
    {
        $request = $this->guzzle->request('currencies');
        $json = json_decode($request->getBody());
        if($request->getStatusCode() !== 200) {
            throw new SkinsMoneyException('SkinsMoney error: ' . $json->message);
        }

        return (object)$json->data;
    }
}