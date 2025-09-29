<?php

namespace Dq\Dq\Models;

use PDO;
use PDOException;

class MonsterModel
{


  private $db;

  public function __construct($database)
  {
    $this->db = $database->getConnection();
  }


  public function Monstre_all()
  {
    try {
      $stmt = $this->db->prepare("
      SELECT
    monsters.id AS monster_id,
    monsters.name AS monster_name,
    monsters.image AS monster_image,
    abilities.id AS ability_id,
    abilities.name AS ability_name,
    abilities.mana AS ability_mana,
    abilities.image AS ability_image
FROM monsters
INNER JOIN monster_abilities ON monsters.id = monster_abilities.monster_id
INNER JOIN abilities ON monster_abilities.ability_id = abilities.id
    ");
      $stmt->execute();
      $monster_tab = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $monstersFinal = [];

      // 3. On parcourt chaque ligne brute
      foreach ($monster_tab as $row) {
        $id = $row['monster_id'];

        // 4. Si ce monstre n’existe pas encore dans $monstersFinal, on le crée
        if (!isset($monstersFinal[$id])) {
          $monstersFinal[$id] = [
            "id" => $row["monster_id"],
            "name" => $row["monster_name"],
            "image" => $row["monster_image"],
            "abilities" => []
          ];
        }

        $monstersFinal[$id]["abilities"][] = [
          "id" => $row["ability_id"],
          "name" => $row["ability_name"],
          "mana" => $row["ability_mana"],
          "image" => $row["ability_image"]
        ];
      }

      return array_values($monstersFinal);
    } catch (PDOException $e) {
      return false;
    }
  }
}
