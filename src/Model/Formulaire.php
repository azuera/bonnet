<?php
namespace Model;
class Formulaire
{
    protected  ?int $index;



    protected ?string $subject='';
    protected ?string $email='';
    protected ?string $Textarea='';

    protected  array $errors =[];



    public function __construct(array $postData=[])
    {
        if(isset($postData['subject'])){
            $this->setSubject(trim($postData['subject']));
        }
        if(isset($postData['email'])){
            $this->setEmail(trim($postData['email']));
        }
        if(isset($postData['Textarea'])){
            $this->setTextarea(trim($postData['Textarea']));
        }




    }
    public function getIndex(): ?int
    {
        return $this->index;
    }


    public function setIndex(?int $index): void
    {
        $this->index = $index;
    }


    public function getSubject(): ?string
    {
        return $this->subject;
    }


    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;
        if (empty($subject)) {
            $this->errors[] = 'sujet manquant';
        } elseif (strlen($subject) <= 10) {
            $this->errors[] = 'veuillez entrer un sujet plus long( 10 cara mini)';
        }
        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }


    public function setEmail(?string $email): self
    {
        $this->email = $email;
        if (empty($email)) {
            $this->errors[] = 'email vide';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'email non valide';
        }
        return $this;
    }


    public function getTextarea(): ?string
    {
        return $this->Textarea;
    }


    public function setTextarea(?string $Textarea): self
    {
        $this->Textarea = $Textarea;
        if (empty($Textarea)) {
            $this->errors[] = 'sujet manquant';
        } elseif (strlen($Textarea) <= 20) {
            $this->errors[] = 'veuillez entrer un sujet plus long( 20 cara mini)';
        }
        return $this;
    }


    public function isSubmited(): bool
    {
        if(
            !empty($this->getSubject())
            || !empty($this->getEmail())
            ||!empty($this->getTextarea()
            )
        ){
            return true;
        }
        return false;
    }

    public  function isValid(): bool{

        return empty($this->errors);
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

}