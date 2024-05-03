<?php
include_once "dbhelper.php";
include_once "State.php";
class Properties
{
    public int $property_id;
    public int|null $agent_id;
    public string $address;
    public string $city;
    public int $state_id;
    public int $zipcode;
    public float $price;
    public int $square_feet;
    public int $bedrooms;
    public int $bathrooms;
    public int $type;
    public string $create_date;

    public function __construct(int $property_id, int|null $agent_id, string $address, string $city, int $state_id, int $zipcode, float $price, int $square_feet, int $bedrooms, int $bathrooms, string $create_date)
    {
        $this->property_id = $property_id;
        $this->agent_id = $agent_id;
        $this->address = $address;
        $this->city = $city;
        $this->state_id = $state_id;
        $this->zipcode = $zipcode;
        $this->price = $price;
        $this->square_feet = $square_feet;
        $this->bedrooms = $bedrooms;
        $this->bathrooms = $bathrooms;
        $this->create_date = $create_date;
    }

    public static function getFromId(int $id): Properties|null
    {
        // i don't think i need this
        $result = dbhelper::getInstance()->query("SELECT * FROM properties WHERE property_id=$id");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Properties(
                $result["property_id"],
                $result["agent_id"],
                $result["address"],
                $result["city"],
                $result["state_id"],
                $result["zipcode"],
                $result["price"],
                $result["square_feet"],
                $result["bedrooms"],
                $result["bathrooms"],
                $result["create_date"]
            );
        }

        return null;
    }

    public function insert() : void {
        $agent_id = $this->agent_id;
        $address = $this->address;
        $city = $this->city;
        $state_id = $this->state_id;
        $zipcode = $this->zipcode;
        $price = $this->price;
        $square_feet = $this->square_feet;
        $bedrooms = $this->bedrooms;
        $bathrooms = $this->bathrooms;

        $sql = "INSERT INTO properties (agent_id, address, city, state_id, zipcode, price, square_feet, bedrooms, bathrooms, create_date) VALUES ($agent_id, '$address', '$city', $state_id, '$zipcode', $price, $square_feet, $bedrooms, $bathrooms, NOW())";

        dbhelper::getInstance()->query($sql);
    }

    public static function searchByFilter(string|null $city=null, int|null $zipcode=null, int|null $price_min=null, int|null $price_max=null, int|null $square_feet_min=null, int|null $square_feet_max=null, int|null $bedroom, int|null $bathroom=null, int $page_size, int $page_number)
    {
        if ($page_number < 0)
        {
            print "<h1 style='font-weight: bold'>Error page NUMBER is less than 0</h1>";
        }
        if ($page_size <= 0)
        {
            print "<h1 style='font-weight: bold'>Error page SIZE is less than or equal to 0</h1>";
        }
        $query = "select * from properties where true";
        if ($city !== null)
        {
            $query .= " and city='$city'";
        }
        if ($zipcode !== null)
        {
            $query .= " and zipcode=$zipcode";
        }
        if ($price_min !== null && $price_max !== null)
        {
            $query .= " and price between $price_min and $price_max";
        }
        if ($square_feet_min !== null && $square_feet_max !== null)
        {
            $query .= " and square_feet between $square_feet_min and $square_feet_max";
        }
        if ($bathroom !== null)
        {
            $query .= " and bathrooms > $bathroom";
        }
        if ($bedroom !== null)
        {
            $query .= " and bedrooms > $bedroom";
        }

        // add limit
        $limit_min = $page_number * $page_size;

        $query .= " limit $limit_min, $page_size";
        // print "limit_min: " . $limit_min;
        // print "limit_max: " . $limit_max;

        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);
        
        if ($result !== null && $result !== false)
        {
            $properties = array();
            foreach ($result as $data)
            {
                $newProperty = new Properties(
                    $data["property_id"],
                    $data["agent_id"],
                    $data["address"],
                    $data["city"],
                    $data["state_id"],
                    $data["zipcode"],
                    $data["price"],
                    $data["square_feet"],
                    $data["bedrooms"],
                    $data["bathrooms"],
                    $data["create_date"]
                );
                $properties[] = $newProperty;
            }
            return $properties;
        }
    }

    public static function getSeachTerms() {
        $query = "SELECT property_id, address, city, zipcode FROM properties";

        $result = dbhelper::getInstance()->query($query);


        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);

        if ($result !== null && $result !== false) {
            $terms = [];

            foreach ($result as $data) {
                $terms[] = array(
                    "value" => $data['address'] . ", " . $data['city'] . ", OH " . $data['zipcode'],
                    "id" => $data['property_id'],
                    "type" => 'address'
                );
            }
        }
        return $terms;
    }

    public function getImages(): null|array
    {
        $images = array();
        $query = "select * from property_media where property_id=$this->property_id";
        
        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);

        if ($result !== null && $result !== false)
        {
            $ids = array();

            foreach ($result as $property_media)
            {
                $ids[] = $property_media['media_id'];
            }

            if (!empty($ids))
            {
                $in_string = "(" . implode(', ', $ids) . ")";
                $media_query = "select * from media where media_id in $in_string";
                
                $media_result = dbhelper::getInstance()->query($media_query);

                if ($media_result !== false) $media_result = $media_result->fetch_all(MYSQLI_ASSOC);

                if ($media_result !== null && $media_result !== false)
                {
                    foreach ($media_result as $media)
                    {
                        $src = $media['file_path'];
                        $images[] = "images/houses/$src";
                    }
                }
            }
        }

        return $images;
    }

    public function formatAddress(): string|null
    {
        $state = State::getFromId($this->state_id);
        if (isset($state))
        {
            return "$this->address, $this->city, $state->abbreviation $this->zipcode";
        }

        return null;
    }

    public static function getAllFromAgentId(int $agent_id): array|null
    {
        $query = "select * from boker.properties where agent_id=$agent_id";

        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);

        return array_map(function ($property) {
            return Properties::getFromId($property['property_id']);
        }, $result);
    }
}