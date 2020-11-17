<?php

namespace ProjetNormandie\MessageBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\DoctrineORMAdminBundle\Filter\ModelAutocompleteFilter;
use Sonata\AdminBundle\Form\Type\ModelListType;

class MessageAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pnmessagebundle_admin_message';


    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('id', TextType::class, ['label' => 'id', 'attr' => ['readonly' => true]])
            ->add('sender', ModelListType::class, [
                'data_class' => null,
                'btn_add' => false,
                'btn_list' => false,
                'btn_delete' => false,
                'btn_catalogue' => false,
                'label' => 'Sender',
                'required' => false
            ])
            ->add('recipient', ModelListType::class, [
                'data_class' => null,
                'btn_add' => false,
                'btn_list' => false,
                'btn_delete' => false,
                'btn_catalogue' => false,
                'label' => 'Recipient',
            ])
            ->add('object', TextType::class, ['label' => 'Object'])
            ->add('message', TextareaType::class, [
                'label' => 'text',
                'required' => true,
            ]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('sender', ModelAutocompleteFilter::class, [], null, [
                'property' => 'username',
            ])
            ->add('recipient', ModelAutocompleteFilter::class, [], null, [
                'property' => 'username',
            ])
            ->add('type');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('type')
            ->add('object', null, ['label' => 'Object'])
            ->add('sender')
            ->add('recipient')
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('id')
            ->add('type')
            ->add('object')
            ->add('sender')
            ->add('recipient')
            ->add('message', null, ['label' => 'Message', 'safe' => true]);
    }
}
