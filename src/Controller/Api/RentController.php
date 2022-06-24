<?php

namespace App\Controller\Api;

use App\Service\RentService;
use App\Traits\ResponseTrait;
use App\Transfer\RentTransfer;
use App\Transformer\RentTransformer;
use App\Validator\RentValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/rents', name: 'rent_')]
class RentController extends AbstractController
{
    use ResponseTrait;

    #[Route('/', name: 'rent_car', methods: 'POST')]
    #[IsGranted('ROLE_USER')]
    public function rents(
        Request $request,
        RentTransfer $rentTransfer,
        RentValidator $rentValidator,
        RentService $rentService,
        RentTransformer $rentTransformer
    ): JsonResponse {
        $dataRequest = json_decode($request->getContent(), true);
        $rentInfo = $rentTransfer->transfer($dataRequest);
        $errors = $rentValidator->validatorRentRequest($rentInfo);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $rent = $rentService->rentCar($rentInfo);
        $result = $rentTransformer->fromArray($rent);
        return $this->success($result);
    }
}
