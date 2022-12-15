<?php
require_once "app/models/FakeDataInstance.php";

class FakeDataModel extends Model {

    static $jsonPath = 'resources/json/results.json';

    function getData()
    {

    }

    function generateData()
    {
        $data = array();

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
        for ($i = 0; $i < 50; $i++) {
            $data_row = new FakeDataInstance(
                $faker->name(),
                $faker->emoji(),
                $faker->colorName(),
                $faker->monthName(),
                $faker->address(),
                $faker->creditCardNumber(),
            );
            $data[] = $data_row;
        }
        $jsonData = json_encode($data);
        file_put_contents(self::$jsonPath, $jsonData);
    }

    function getRawData(): array {
        $input = file_get_contents(self::$jsonPath);
        return json_decode($input);
    }

    function getDayCount($data): array
    {
        $day_count = array();
        foreach ($data as $row) {
            $weekday = $row->weekday;
            if(!isset($day_count[$weekday])) {
                $day_count[$weekday] = 0;
            }
            $day_count[$weekday] += 1;
        }
        return $this->getLabelsAndValues($day_count);
    }

    function getCreditCardNum($data): array
    {
        $credit_card_count = array();
        foreach ($data as $row) {
            $creditN = ((string)$row->creditCard)[0];
            if(!isset($credit_card_count[$creditN])) {
                $credit_card_count[$creditN] = 0;
            }
            $credit_card_count[$creditN] += 1;
        }
        return $this->getLabelsAndValues($credit_card_count);
    }

    function getMonthCount($data): array
    {
        $count = array();
        foreach ($data as $row) {
            $value = $row->month;
            if(!isset($count[$value])) {
                $count[$value] = 0;
            }
            $count[$value] += 1;
        }
        return $this->getLabelsAndValues($count);
    }

    function getDayColorTuple(): array {
        $data = $this->getRawData();
        $color_array = array();
        $month_array = array();
        $color_keys = array();
        $month_keys = array();
        foreach ($data as $row) {
            if (!in_array($row->month, $month_keys)) {
                $month_keys[] = $row->month;
            }
            if (!in_array($row->color, $color_keys)) {
                $color_keys[] =$row->color;
            }
        }
        $month_keys = array_flip($month_keys);
        $color_keys = array_flip($color_keys);
        foreach ($data as $row) {
            $month_array[] = $month_keys[$row->month];
            $color_array[] = $color_keys[$row->color];
        }
        return array(
            "month" => $month_array,
            "color" => $color_array,
            "month_keys" => array_values($month_keys),
            "color_keys" => array_values($color_keys)
        );
    }

    function getLabelsAndValues($data) {
        $labels = array_keys($data);
        $values = array_values($data);
        return array("labels" => $labels, "values" => $values);
    }
}