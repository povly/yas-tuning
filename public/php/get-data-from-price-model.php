<?php

header('Content-Type: application/json');

$type = $_POST['type'] ?? null;
$brand_id = intval($_POST['brand_id'] ?? 0);

if ($type === 'models'){
  if ($brand_id === 1){
    echo json_encode([["model"=>"147"],["model"=>"156"],["model"=>"159"],["model"=>"166"],["model"=>"4C"],["model"=>"Brera"],["model"=>"CrossWagon"],["model"=>"Giulia"],["model"=>"Giulietta"],["model"=>"GT"],["model"=>"MiTo"],["model"=>"Spider"],["model"=>"Stelvio"]]);
    exit;
  }
} else if ($type === 'years'){
  $model = $_POST['model'] ?? null;

  if ($brand_id === 1){
    if ($model === '147'){
      echo json_encode([["year"=>"2001 -> 2005"],["year"=>"2005 -> ..."]]);
      exit;
    }
  }
} else if ($type === 'engines'){
  $model = $_POST['model'] ?? null;
  $year = $_POST['year'] ?? null;

  if ($brand_id === 1){
    if ($model === '147'){
      if ($year === '2001 -> 2005') {
        echo json_encode([["id"=>"4932","motor"=>"1.9Jtd","hp"=>"100hp"],["id"=>"4933","motor"=>"1.9Jtd","hp"=>"115hp"],["id"=>"4934","motor"=>"1.9Jtd","hp"=>"136hp"],["id"=>"4935","motor"=>"1.9Jtd","hp"=>"140hp"],["id"=>"4930","motor"=>"2.0  TS","hp"=>"150hp"],["id"=>"4931","motor"=>"3.2  V6 GTA","hp"=>"250hp"]]);
        exit;
      }
    }
  }
} else if ($type === 'info'){
  $car_id = $_POST['car_id'] ?? null;
  if ($car_id === '4932'){
    echo json_encode([
      ["type"=>"stage 1","meer_info"=>"Power","original"=>"100 hp","after_tuning"=>"135 hp","verschil"=>"+ 35 hp"],
      ["type"=>"stage 1","meer_info"=>"Torque","original"=>"200 Nm","after_tuning"=>"265 Nm","verschil"=>"+ 65 Nm"],
      ["type"=>"eco","meer_info"=>"Torque","original"=>"200 Nm","after_tuning"=>"265 Nm","verschil"=>"+ 65 Nm"],
      ["type"=>"eco","meer_info"=>"\nEstimated fuel reduction\n","original"=>"","after_tuning"=>"","verschil"=>"\n+/- 17 %\n"]
    ]);
    exit;
  } else if ($car_id === '4933'){
    echo json_encode([
      ["type"=>"stage 1","meer_info"=>"Power","original"=>"115 hp","after_tuning"=>"145 hp","verschil"=>"+ 30 hp"],
      ["type"=>"stage 1","meer_info"=>"Torque","original"=>"275 Nm","after_tuning"=>"330 Nm","verschil"=>"+ 55 Nm"],
      ["type"=>"eco","meer_info"=>"Torque","original"=>"275 Nm","after_tuning"=>"330 Nm","verschil"=>"+ 55 Nm"],
      ["type"=>"eco","meer_info"=>"\nEstimated fuel reduction\n","original"=>"","after_tuning"=>"","verschil"=>"\n+/- 10 %\n"]
    ]);
    exit;
  }
}


echo json_encode([
  "status" => "error",
  "message" => "Пусто",
]);
exit;
