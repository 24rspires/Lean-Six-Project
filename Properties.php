<?php

class Properties
{
    public int $id;
    public int $ownerId;
    public string $address;
    public string $city;
    public int $stateId;
    public int $zip;
    public float $price;
    public int $squareFoot;
    public int $beds;
    public int $bath;
    public string $createDate;

    public function __construct(int $id, int $ownerId, string $address, string $city, int $stateId, int $zip, float $price, int $squareFoot, int $beds, int $bath, string $createDate)
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
}