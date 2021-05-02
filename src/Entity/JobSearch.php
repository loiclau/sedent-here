<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class JobSearch{

    /**
     * @var string
     */
    private $address;
    /**
     * @var int|null
     * @Assert\Range (min = 20000)
     */
    private $minSalary;

    /**
     * @var ArrayCollection
     */
    private $technos;


    public function __construct(){
        $this->technos = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return JobSearch
     */
    public function setAddress(string $address): JobSearch
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSalary(): ?int
    {
        return $this->minSalary;
    }

    /**
     * @param int $minSalary
     * @return JobSearch
     */
    public function setMinSalary(int $minSalary): JobSearch
    {
        $this->minSalary = $minSalary;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTechnos(): ArrayCollection
    {
        return $this->technos;
    }

    /**
     * @param ArrayCollection $technos
     * @return JobSearch
     */
    public function setTechnos(ArrayCollection $technos): JobSearch
    {
        $this->technos = $technos;
        return $this;
    }





}