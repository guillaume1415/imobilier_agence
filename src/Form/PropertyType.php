<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,[
                'label' => 'Titre'
            ])
            ->add('description',null,[
                'label' => 'Description'
            ])
            ->add('surface',null,[
                'label' => 'Surface'
            ])
            ->add('rooms',null,[
                'label' => 'Pièces'
            ])
            ->add('bedrooms',null,[
                'label' => 'Chambres'
            ])
            ->add('floor',null,[
                'label' => 'Etages'
            ])
            ->add('price',null,[
                'label' => 'Prix'
            ])
            ->add('heat',ChoiceType::class,[
                'choices' => $this->getChoices(),
                'label' => 'Chauffage'
            ])
            ->add('options', EntityType::class,[
                'class' => Option::class,
                'choice_label'=> 'name',
                'multiple' => true,
                'required' => false
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('city',null,[

                'label' => 'Ville'

            ])
            ->add('adress',null,[
                'label' => 'Adresse'
            ])
            ->add('postal_code',null,[
                'label' => 'Code postal'
            ])
            ->add('sold',null,[
                'label' => 'Vendu'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }
        return $output;
    }
}
