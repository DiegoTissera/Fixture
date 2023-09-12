<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AppBundle\Entity\Team;


/**
 *
 */
class MatchSoccerType extends AbstractType
{

	public function buildform(FormBuilderInterface $builder, array $options)
	{
		$builder

		// 	->add('datetime', DateTimeType::class, [
		// 		'data' => new \DateTime()
		// 	]
		// )
			->add("datetime", DateTimeType::class,[
                'widget'        => "choice",
                'format'        => "yyyy-MM-dd HH:mm:ss",
                ]
            )

			->add('home', EntityType::class, [
				'disabled'      => $builder->getData() && $builder->getData()->getId(),
			    'class' => 'AppBundle\Entity\Team',
			    'choice_label' => 'Name',
			    'placeholder' => 'select option',
			    'query_builder' => function ($repository) {
			        return $repository->createQueryBuilder('t')
			            ->orderBy('t.name', 'ASC');
			    },
			])
			->add('visitor', EntityType::class, [
				'disabled'      => $builder->getData() && $builder->getData()->getId(),
			    'class' => 'AppBundle\Entity\Team',
			    'choice_label' => 'Name',
			    'placeholder' => 'select option',
			     'query_builder' => function ($repository) {
			        return $repository->createQueryBuilder('t')
			            ->orderBy('t.name', 'ASC');
			    },
			])
			->add('homegoals', IntegerType::class, [
				'required'=>false,
			])
			->add('visitorgoals', IntegerType::class, [
				'required'=>false,
			])
			->add('submit', SubmitType::class);
		}
	}