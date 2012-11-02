<?php 

namespace DanFinnie\GasBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LogRecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mileage', 'text');
        $builder->add('gallonsAdded', 'text');

        //if (!isset($options['hideCar']) || !$options['hideCar']) {
           $builder->add('car', 'entity', array(
             'class' => 'DanFinnieGasBundle:Car',
             'property' => 'name',
             'multiple' => false,
           ));
        //}
    }

    public function getName()
    {
        return 'logRecord';
    }
}
