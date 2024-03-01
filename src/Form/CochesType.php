<?php

namespace App\Form;

use App\Entity\Coches;
use App\Entity\Modelos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/*
* Lista de tipos de campos para los formularios:
* (Hay que importar de Symfony\Component\Form\Extension\Core\Type\)
* - TextType 
* - NumberType
* - DateType
* - EntityType
* - TextAreaType
* - EmailType
* - PasswordType
* - FileType
* - ChoiceType
* - SubmitType
*/

class CochesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricula')
            ->add('precio', NumberType::class, ["scale" => 2, "attr" => ["step" => 0.5]])
            ->add('estado')
            ->add('kms')
            ->add('fecha', DateType::class, ["widget" => "single_text"])
            ->add('id_modelo', EntityType::class, [
                'class' => Modelos::class,
                'choice_label' => 'nombre_modelo',
            ])
            ->add('guardar', SubmitType::class, ["label" => "Insertar coche", 'attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coches::class,
        ]);
    }
}
