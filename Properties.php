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

    public static function getFromId(int $id): Properties
    {
        // i don't think i need this
        $result = dbhelper::getInstance()->query("SELECT * FROM properties WHERE property_id=$id");
        
        if ($result !== false) $result = $result->fetch_assoc();

        if ($result !== false && $result !== null)
        {
            return new Properties(
                $result["property_id"],
                $result["owner_id"],
                $result["address"],
                $result["city"],
                $result["state_id"],
                $result["zipcode"],
                $result["price"],
                $result[""]
            );
        }
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
        $limit_max = $limit_min + $page_size;

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

    public static function getSeachTerms() {
        $query = "select property_id, address, city, zipcode from boker.properties";

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
        $query = "select * from boker.property_media where property_id=$this->id";
        
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
                $media_query = "select * from boker.media where media_id in $in_string";
                
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
}