<?php declare(strict_types=1);


namespace App\Model\Entity;



use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class Sector
 * @package App\Model\Entity
 * @ORM\Entity()
 */
class Sector
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="SubSector", mappedBy="sector", cascade={"remove"})
     * @var Collection 
     */
    private Collection $subSectors;

    /**
     * Sector constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->subSectors = new ArrayCollection([]);
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return SubSector[]
     */
    public function getSubSectors(): array
    {
        return $this->subSectors->toArray();
    }
    
    

}