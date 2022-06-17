<?php

namespace App\Repository;

use App\Entity\Car;
use App\Request\ListCarRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends BaseRepository
{
    const CAR_ALIAS = 'c';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class, static::CAR_ALIAS);
    }

    public function all(ListCarRequest $listCarRequest)
    {
        $cars = $this->createQueryBuilder(static::CAR_ALIAS);
        $cars = $this->filter($cars, 'color', $listCarRequest->getColor());
        $cars = $this->andFilter($cars, 'brand', $listCarRequest->getBrand());
        $cars = $this->andFilter($cars, 'seats', $listCarRequest->getSeats());
        $cars = $this->sortBy($cars, $listCarRequest->getOrderBy());
        $cars->setMaxResults($listCarRequest->getLimit())->setFirstResult(0);

        return $cars->getQuery()->getResult();
    }
}
