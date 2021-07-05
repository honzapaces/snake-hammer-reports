<?php declare(strict_types=1);


namespace App\Model\Serializer;


use App\Model\Entity\Sector;
use App\Model\Entity\SubSector;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;

class ObjectNormalizer extends \Symfony\Component\Serializer\Normalizer\ObjectNormalizer
{
    private EntityManager $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    protected function instantiateObject(array &$data, string $class, array &$context, \ReflectionClass $reflectionClass, $allowedAttributes, string $format = null)
    {
        try {
            return parent::instantiateObject($data, $class, $context, $reflectionClass, $allowedAttributes, $format);
        } catch (MissingConstructorArgumentsException $exception) {

            //try create entites with relations
            if (strtolower($class) === strtolower(SubSector::class) && isset($data['sector_id'])) {
                $data['sector'] = $this->entityManager->getRepository(Sector::class)->findOneBy(['id' => $data['sector_id']]);
            }
            return parent::instantiateObject($data, $class, $context, $reflectionClass, $allowedAttributes, $format);
        }
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        if ($data instanceof $type) {
            return $data;
        }
        return parent::denormalize($data, $type, $format, $context);
    }

}