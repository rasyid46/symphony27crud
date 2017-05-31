<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// src/AppBundle/Form/ProductType.php

namespace AppBundle\Form;

use AppBundle\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
               ->add('no', 'text')
                ->add('name', 'text')
                ->add('author', 'text')
                ->add('language', 'text')
                ->add('publisher', 'text')
                ->add('summary', 'text')
                ->add('brochure', 'file', array('label' => 'Brochure (PDF file)'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Book::class,
        ));
    }

    public function getName() {
        return 'book';
    }

}
