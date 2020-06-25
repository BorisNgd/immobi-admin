<?php

namespace App\Form;

use App\Entity\House;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('reference')
            ->add('area')
            ->add('price')
            ->add('pictureFile' , VichImageType::class, [
                'label' => 'Please upload a file',
                'required' => 'false',
                'mapped' => true,
                'by_reference' => false,
                'attr' => [
                    'class'=> ''
                ],

            ])
            ->add('description' , CKEditorType::class)
            ->add('numberOfRoom')
            ->add('numberOfBedRoom')
            ->add('numberOfKitchenRoom')
            ->add('numberOfLivingRoom')
            ->add('entranceCondition' , CKEditorType::class , [

            ])
            ->add('promote' , CheckboxType::class, [
                'label' => false,
            ])
            ->add('HouseType')
            ->add('Attachments' , CollectionType::class , [
                'entry_type' => AttachmentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'mapped' => true
            ])
            ->add('Location')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
