<?php

namespace App\Controller\Api;

use App\Service\MailService;
use App\Traits\ResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/mails', name: 'mail_')]
class MailController extends AbstractController
{
    use ResponseTrait;

    #[Route('/', name: 'send_mail', methods: 'GET')]
    public function sendMailToUser(MailService $mailService)
    {
        $mailService->sendMail();
        return $this->success([]);
    }
}
