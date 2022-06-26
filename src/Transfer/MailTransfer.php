<?php

namespace App\Transfer;
use Symfony\Component\Validator\Constraints as Assert;

class MailTransfer extends BaseTransfer
{
    #[Assert\Email()]
    private $mailAddress;

    #[Assert\Type('string')]
    private $nameOfUser;

    #[Assert\Type('string')]
    private $mailSubject;

    #[Assert\Type('string')]
    private $mailBody;

    /**
     * @return mixed
     */
    public function getMailAddress()
    {
        return $this->mailAddress;
    }

    /**
     * @param mixed $mailAddress
     */
    public function setMailAddress($mailAddress): void
    {
        $this->mailAddress = $mailAddress;
    }

    /**
     * @return mixed
     */
    public function getNameOfUser()
    {
        return $this->nameOfUser;
    }

    /**
     * @param mixed $nameOfUser
     */
    public function setNameOfUser($nameOfUser): void
    {
        $this->nameOfUser = $nameOfUser;
    }

    /**
     * @return mixed
     */
    public function getMailSubject()
    {
        return $this->mailSubject;
    }

    /**
     * @param mixed $mailSubject
     */
    public function setMailSubject($mailSubject): void
    {
        $this->mailSubject = $mailSubject;
    }

    /**
     * @return mixed
     */
    public function getMailBody()
    {
        return $this->mailBody;
    }

    /**
     * @param mixed $mailBody
     */
    public function setMailBody($mailBody): void
    {
        $this->mailBody = $mailBody;
    }
}
