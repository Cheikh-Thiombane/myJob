<?php

namespace App\Entity;

use App\Repository\PasswordUpdateRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\EqualTo;
use  Symfony\Component\Validator\Constraints as Assert;

class PasswordUpdate
{



/**
     *
     * @Assert\Length(min=8, minMessage="doit contenir au moins 8 caractéres")
     */
    private $newPassword;

    /**
     *
     * @Assert\EqualTo(propertyPath="newPassword", message="echec Confirmation")
     */
    private $confirmPassword;
    

    private $oldPassword;





    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}
