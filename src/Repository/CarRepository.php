<?php

namespace App\Repository;

use App\Entity\Car;
use App\Request\ListCarRequest;
use App\Transfer\FilterTransfer;
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
    const FIRST_RESULT = 0;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class, static::CAR_ALIAS);
    }

    public function all(FilterTransfer $filterTransfer)
    {
        $cars = $this->createQueryBuilder(static::CAR_ALIAS);
        $cars = $this->filter($cars, 'color', $filterTransfer->getColor());
        $cars = $this->andFilter($cars, 'brand', $filterTransfer->getBrand());
        $cars = $this->andFilter($cars, 'seats', $filterTransfer->getSeats());
        $cars = $this->sortBy($cars, $filterTransfer->getOrderBy(), $filterTransfer->getOrderType());
        $cars->setMaxResults($filterTransfer->getLimit())->setFirstResult(static::FIRST_RESULT);

        return $cars->getQuery()->getResult();
    }
}
