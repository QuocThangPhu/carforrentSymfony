<?php

namespace App\Controller\Api;

use App\Service\MailService;
use App\Traits\ResponseTrait;
use App\Transfer\MailTransfer;
use App\Validator\EmailValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/mails', name: 'mail_')]
class MailController extends AbstractController
{
    use ResponseTrait;

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/', name: 'send_mail', methods: 'POST')]
    public function sendMailToUser(
        MailService    $mailService,
        Request        $request,
        MailTransfer   $mailTransfer,
        EmailValidator $emailValidator
    )
    {
        $dataRequest = json_decode($request->getContent(), true);
        $mail = $mailTransfer->transfer($dataRequest);
        $errors = $emailValidator->validatorEmailRequest($mail);
        if (!empty($errors)) {
            return $this->error($errors);
        }
        $mailService->sendMail($mail);
        return $this->success([]);
    }
}
