<?php declare(strict_types=1);


namespace App\AdminModule\Presenters;

use Doctrine\ORM\EntityManager;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\BadRequestException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class EntityPresenter extends BaseAdminPresenter
{
    private Serializer $serializer;
    private EntityManager $entityManager;

    /**
     * EntityPresenter constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer, EntityManager $entityManager)
    {
        parent::__construct();
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }


    /**
     * @throws \Nette\Application\AbortException
     */
    #[NoReturn] public function actionDefault(): void
    {
        $this->sendJson(['hello' => 'world!']);
    }

    /**
     * @param string $name
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Nette\Application\AbortException
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    #[NoReturn] public function actionNew(string $name): void
    {
        $entityClass = $this->formatEntityParameter($name);
        $newEntity = $this->serializer->deserialize($this->getHttpRequest()->getRawBody(), $entityClass, JsonEncoder::FORMAT);
        $this->entityManager->persist($newEntity);
        $this->entityManager->flush($newEntity);
        $this->sendJson(
            $this->serializer->normalize(
                $newEntity
            )
        );
    }

    /**
     * @param string   $name
     * @param int|null $id
     * @throws \Nette\Application\AbortException
     */
    #[NoReturn] public function actionGet(string $name, ?int $id): void
    {
        $entityClass = $this->formatEntityParameter($name);
        if ($id !== null) {
            $data = $this->entityManager->getRepository($entityClass)->findOneBy(["id" => $id]);
        } else {
            $data = $this->entityManager->getRepository($entityClass)->findAll();
        }
        $this->sendJson($this->serializer->normalize(
            $data
        ));
    }

    /**
     * @param string   $name
     * @param int $id
     * @throws \Nette\Application\AbortException
     */
    #[NoReturn] public function actionDelete(string $name, int $id): void
    {
        $entityClass = $this->formatEntityParameter($name);
        $data = $this->entityManager->getRepository($entityClass)->findOneBy(["id" => $id]);
        if($data === null) {
            throw new BadRequestException(sprintf("Entity %s with id %d doesn't exits", $name, $id));
        }
        $this->entityManager->remove($data);
        $this->entityManager->flush();
        
        $this->sendJson([]);
    }

    private function formatEntityParameter(string $name): string
    {
        return sprintf("App\Model\Entity\%s", $name);
    }

}