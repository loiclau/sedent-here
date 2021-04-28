<?php
namespace App\Entity;

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





}