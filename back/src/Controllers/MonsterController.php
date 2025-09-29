<?php

namespace  Dq\Dq\Controllers;

use Dq\Dq\Models\MonsterModel;
use Exception;
use PDOException;

class MonsterController
{

  private $monstermodel;


  public function __construct($database)
  {
    $this->monstermodel = new MonsterModel($database);
  }

  public function  all_monster()
  {

    try {
      $monster = $this->monstermodel->Monstre_all();



      if ($monster) {
        echo json_encode([
          "status" => "success",
          "message" => "monstre trouvé",
          "monster" => $monster
        ]);
      } else {
        echo json_encode([
          "status" => "empty",
          "message" => "Aucun monstre trouvé"
        ]);
      }
    } catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
    echo "<pre>";
    print_r($e->getTrace());
    echo "</pre>";
    return false;
}

  }
}
