<?php


class Product
{
    private $conn;
    private $name;
    private $description;
    private $price;
    private $category_id;
    private $created;

    /**
     * Product constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated()
    {
        $date = new DateTime();

        $this->created = $date->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */


    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }



    public function create () {

        $this->setCreated();

        $sql = "INSERT INTO products(name, price, description, created, category_id)
                VALUES('$this->name', $this->price, '$this->description', '$this->created', $this->category_id)";

        return $this->conn->exec($sql);

//        var_dump($sql);
    }

    function getAll() {
        $query = $this->conn->prepare("select products.*, 
                                        categories.name as category 
                                        from products
                                        inner join
                                        categories on
                                        products.category_id = categories.id");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteProduct($conn, $id) {
        $sql = "DELETE FROM products WHERE id=$id";
        $conn->exec($sql);
    }
}