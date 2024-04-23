<?php
include_once "dbhelper.php";
class State
{
    public int $state_id;
    public string $name;
    public string $abbreviation;

    public function __construct(int $state_id, string $name, string $abbreviation)
    {
        $this->state_id = $state_id;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
    }

    public static function getFromId(int $id): State|null
    {
        $result = dbhelper::getInstance()->query("SELECT * FROM state WHERE state_id=$id");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new State(
                $result["state_id"],
                $result["name"],
                $result["abbreviation"],
            );
        }

        return null;
    }

    public static function getAll(): array|null
    {
        $results = dbhelper::getInstance()->query("SELECT * FROM state");
        $states = [];

        if ($results !== false) $results = $results->fetch_all(MYSQLI_ASSOC);

        if ($results !== false && $results !== null)
        {
            foreach ($results as $state)
            {
                $states[] = new State(
                    $state["state_id"],
                    $state["name"],
                    $state["abbreviation"],
                );
            }
        }

        return $states;
    }
}