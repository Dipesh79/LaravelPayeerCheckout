<?php

namespace Dipesh79\LaravelPayeerCheckout;


class LaravelPayeerCheckout
{
    private $shop;
    private $merchant_key;

    public function __construct()
    {
        $this->shop = config('payeer.shop');
        $this->merchant_key = config('payeer.merchant_key');
    }

    public function payeerCheckout($amount, $order, $description, $curency = 'USD')
    {
        if (!$this->shop)
        {
            throw new \Exception("Shop Id Not Found");
        }
        if (!$this->merchant_key)
        {
            throw new \Exception("Merchant Key Not Found");
        }
        $m_amount = number_format($amount, 2, '.', '');
        $m_shop = $this->shop;
        $m_order_id = $order;
        $m_curr = $curency;
        $m_desc = base64_encode($description);
        $m_key = $this->merchant_key;

        $arHash = array(
            $m_shop,
            $m_order_id,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key
        );
        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        $arGetPatams = array(
            'm_shop' => $m_shop,
            'm_orderid' => $m_order_id,
            'm_amount' => $m_amount,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'm_sign' => $sign
        );
        $url = 'https://payeer.com/merchant/?' . http_build_query($arGetPatams);
        return $url;
    }
}
