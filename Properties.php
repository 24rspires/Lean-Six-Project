<?php
// https://gist.github.com/bryant988/9510cff838d86dcefa3b9ea3835b8552?permalink_comment_id=4706389
include_once "dbhelper.php";
class Properties
{
    public int $id;
    public int|null $ownerId;
    public string $address;
    public string $city;
    public int $stateId;
    public int $zip;
    public float $price;
    public int $squareFoot;
    public int $beds;
    public int $bath;
    public string $createDate;

    public function __construct(int $id, int|null $ownerId, string $address, string $city, int $stateId, int $zip, float $price, int $squareFoot, int $beds, int $bath, string $createDate)
    {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->city = $city;
        $this->stateId = $stateId;
        $this->zip = $zip;
        $this->price = $price;
        $this->squareFoot = $squareFoot;
        $this->beds = $beds;
        $this->bath = $bath;
        $this->createDate = $createDate;
    }

    public function insertIntoDatabase() : void {
        $ownId = $this->ownerId;
        $addr = $this->address;
        $cty = $this->city;
        $stId = $this->stateId;
        $zip = $this->zip;
        $price = $this->price;
        $sqFt = $this->squareFoot;
        $bed = $this->beds;
        $bath = $this->bath;

        $sql = "INSERT INTO properties (owner_id, address, city, state_id, zipcode, price, square_feet, bedrooms, bathrooms, create_date) VALUES ($ownId, '$addr', '$cty', $stId, '$zip', $price, $sqFt, $bed, $bath, NOW())";

        dbhelper::getInstance()->query($sql);
    }

    public static function searchByFilter(string|null $city=null, int|null $zipcode=null, int|null $price_min=null, int|null $price_max=null, int|null $square_feet_min=null, int|null $square_feet_max=null, int|null $bedroom_min=null, int|null $bedroom_max=null, int|null $bathroom_min=null, int|null $bathroom_max=null)
    {
        $query = "select * from boker.properties where true";
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
        if ($bathroom_min !== null && $bathroom_max !== null)
        {
            -
            $query .= " and bathrooms between $bathroom_min and $bathroom_max";
        }
        if ($bedroom_min !== null && $bedroom_max !== null)
        {
            $query .= " and bedrooms between $bedroom_min and $bedroom_max";
        }

        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);
        
        if ($result !== null && $result !== false)
        {
            $properties = array();
            foreach ($result as $data)
            {
                $newProperty = new Properties(
                    $data["property_id"],
                    $data["owner_id"],
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

    public function getImages(): null|array
    {
        $this->id=133; // delete this
        $query = "select * from boker.property_media where property_id=$this->id";
        
        $result = dbhelper::getInstance()->query($query);

        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);

        if ($result !== null && $result !== false)
        {
            $ids = array();

            foreach ($result as $property_media)
            {
                $ids[] = $property_media['id'];
            }

            $in_string = "(" . implode(', ', $ids) . ")"
            $media_query = "select * from boker.media where media_id in $in_string";

            $media_result = dbhelper::getInstance()->query($media_query);

            if ($media_result !== false) $media_result = $media_result->fetch_all(MYSQLI_ASSOC);

            if ($media_result !== null && $media_result !== false)
            {

            }
        }
    }
}