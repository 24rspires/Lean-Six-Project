<?php
include_once "dbhelper.php";
class Properties
{
    public int $id;
    public int | null $ownerId;
    public string $address;
    public string $city;
    public int $stateId;
    public int $zip;
    public float $price;
    public int $squareFoot;
    public int $beds;
    public int $bath;
    public string $createDate;

    public function __construct(int $id, int | null $ownerId, string $address, string $city, int $stateId, int $zip, float $price, int $squareFoot, int $beds, int $bath, string $createDate)
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

    public static function getAll() {
        $result = dbhelper::getInstance()->query("Select * From boker.properties");
        $properties_arr = array();
        if ($result !== false) $result = $result->fetch_all(MYSQLI_ASSOC);

        if ($result !== false && $result !== null)
        {
            foreach ( $result as $item) {
                $new_properties = new Properties(
                    $item['property_id'],
                    $item['owner_id'],
                    $item['address'],
                    $item['city'],
                    $item['state_id'],
                    $item['zipcode'],
                    $item['price'],
                    $item['square_feet'],
                    $item['bedrooms'],
                    $item['bathrooms'],
                    $item['create_date'],
                );
                $properties_arr[] = $new_properties;
            }
        }
        return $properties_arr;
    }

}