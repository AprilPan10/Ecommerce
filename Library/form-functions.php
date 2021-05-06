<?php

function populateDropdown($products, $select = ""){
    $html_dropdown = "";
    foreach ($products as $product) {
        $selected = $select == $product->name ? "selected" : "";
        $html_dropdown .= "<option $selected value='$product->id'>$product->name</option>";
    }

    return $html_dropdown;
}