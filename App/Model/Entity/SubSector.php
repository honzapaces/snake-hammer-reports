<?php declare(strict_types=1);


namespace App\Model\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Sector
 * @package App\Model\Entity
 *
 * @ORM\Entity()
 */
class SubSector
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
     * @ORM\ManyToOne(targetEntity="Sector",cascade={"remove"})
     * @ORM\JoinColumn()
     * @var Sector
     */
    private Sector $sector;

    /**
     * SubSector constructor.
     * @param Sector $sector
     * @param string $name
     */
    public function __construct(Sector $sector, string $name)
    {
        $this->sector = $sector;
        $this->name = $name;
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
     * @return Sector
     */
    public function getSector(): Sector
    {
        return $this->sector;
    }

    /**
     * Should sector be changeable? i guess only when admin make mistake
     * @param Sector $sector
     */
    public function setSector(Sector $sector): void
    {
        $this->sector = $sector;
    }

}