<?php

namespace ProjetNormandie\MessageBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MessageAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pnmessagebundle_admin_message';


    /**
     * @inheritdoc
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('export');
    }

    /**
     * @inheritdoc
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('idMessage', 'text', ['label' => 'idMessage', 'attr' => ['readonly' => true]])
            ->add('sender', 'sonata_type_model_list', [
                'data_class' => null,
                'btn_add' => false,
                'btn_list' => false,
                'btn_delete' => false,
                'btn_catalogue' => false,
                'label' => 'Sender',
                'required' => false
            ])
            ->add('recipient', 'sonata_type_model_list', [
                'data_class' => null,
                'btn_add' => false,
                'btn_list' => false,
                'btn_delete' => false,
                'btn_catalogue' => false,
                'label' => 'Recipient',
            ])
            ->add('object', 'text', ['label' => 'Object'])
            ->add('message', 'textarea', [
                'label' => 'text',
                'required' => true,
            ]);
    }

    /**
     * @inheritdoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('sender', 'doctrine_orm_model_autocomplete', [], null, [
                'property' => 'username',
            ])
            ->add('recipient', 'doctrine_orm_model_autocomplete', [], null, [
                'property' => 'username',
            ])
            ->add('type');
    }

    /**
     * @inheritdoc
     * @throws \RuntimeException When defining wrong or duplicate field names.
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('idMessage')
            ->add('type')
            ->add('object', null, ['label' => 'Object'])
            ->add('sender')
            ->add('recipient')
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @inheritdoc
     * @throws \RuntimeException When defining wrong or duplicate field names.
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper->add('idMessage')
            ->add('type')
            ->add('object')
            ->add('sender')
            ->add('recipient')
            ->add('message');
    }
}
