<?php 

namespace DanFinnie\GasBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class LogRecordNoCarType extends LogRecordType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('car', 'hidden', array(
            'property_path' => 'car.id',
        ));
    }

    public function getName()
    {
        return 'logRecordNoCar';
    }
}
