<?php

// convertir le fichier yml en array diviser par "-by" pour chaque table
$content = file_get_contents('fixtures/extrait.yml');
$products = yaml_parse($content);

print_r($products);
