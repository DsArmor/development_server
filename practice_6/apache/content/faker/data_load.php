<?php

function get_raw_data(): array {
    $input = file_get_contents('results.json');
    # echo print_r(json_decode($input));
    return json_decode($input);
}

function get_day_count($data): array
{
    $day_count = array();
    foreach ($data as $row) {
        $weekday = $row->weekday;
        if(!isset($day_count[$weekday])) {
            $day_count[$weekday] = 0;
        }
        $day_count[$weekday] += 1;
    }
    return $day_count;
}

function get_blood_type_count($data): array
{
    $blood_type_count = array();
    foreach ($data as $row) {
        $bloodType = $row->bloodType;
        if(!isset($blood_type_count[$bloodType])) {
            $blood_type_count[$bloodType] = 0;
        }
        $blood_type_count[$bloodType] += 1;
    }
    return $blood_type_count;
}

function get_credit_card_num($data): array
{
    $credit_card_count = array();
    foreach ($data as $row) {
        $creditN = ((string)$row->creditCard)[0];
        if(!isset($credit_card_count[$creditN])) {
            $credit_card_count[$creditN] = 0;
        }
        $credit_card_count[$creditN] += 1;
    }
    return $credit_card_count;
}

function get_month_count($data): array
{
    $count = array();
    foreach ($data as $row) {
        $value = $row->month;
        if(!isset($count[$value])) {
            $count[$value] = 0;
        }
        $count[$value] += 1;
    }
    return $count;
}

function get_day_color_tuple(): array {
    $data = get_raw_data();
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

function get_labels_and_values($func) {
    $raw_data = get_raw_data();
    $day_count = $func($raw_data);
    $labels = array_keys($day_count);
    $values = array_values($day_count);
    return array("labels" => $labels, "values" => $values);
}