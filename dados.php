<?php
// $vacinas = $pdo->query("SELECT * FROM vacinas WHERE usuario_id = 1")->fetchAll();

$vacinas = [
    ['nome' => 'BCG',            'status' => 'tomada',   'data' => '2020-03-15', 'dose' => 'Dose única'],
    ['nome' => 'Hepatite B',     'status' => 'tomada',   'data' => '2020-03-15', 'dose' => '1ª Dose'],
    ['nome' => 'Tríplice Viral', 'status' => 'tomada',   'data' => '2021-06-10', 'dose' => '2ª Dose'],
    ['nome' => 'COVID-19',       'status' => 'tomada',   'data' => '2022-01-20', 'dose' => 'Reforço'],
    ['nome' => 'Febre Amarela',  'status' => 'faltante', 'data' => null,         'dose' => 'Dose única'],
    ['nome' => 'Influenza',      'status' => 'faltante', 'data' => null,         'dose' => 'Anual'],
    ['nome' => 'HPV',            'status' => 'faltante', 'data' => null,         'dose' => '2ª Dose'],
];