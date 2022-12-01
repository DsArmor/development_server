<?php

class FakeDataInstance
{
    public string $name;
    public string $color;
    public string $month;
    public string $address;
    public string $emoji;
    public string $creditCard;

    /**
     * @param string $name
     * @param string $color
     * @param string $month
     * @param string $address
     * @param string $emoji
     * @param string $creditCard
     */
    public function __construct(string $name, string $emoji, string $color, string $month, string $address, string $creditCard)
    {
        $this->name = $name;
        $this->color = $color;
        $this->month = $month;
        $this->address = $address;
        $this->emoji = $emoji;
        $this->creditCard = $creditCard;
    }

}