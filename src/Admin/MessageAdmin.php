<?php

namespace ProjetNormandie\MessageBundle\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelListType;

class MessageAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'pnmessagebundle_admin_message';

    /**
     * @param RouteCollectionInterface $collection
     */
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('export')
            ->remove('create');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('id', TextType::class, ['label' => 'id', 'attr' => ['readonly' => true]])
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
            ->add('message', CKEditorType::class, [
                'label' => 'Message',
                'required' => true,
                'config' => array(
                    'height' => '200',
                    'toolbar' => 'standard'
                ),
            ]);
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('sender', ModelFilter::class, [
                 'field_type' => ModelAutocompleteType::class,
                 'field_options' => ['property'=>'username'],
            ])
            ->add('recipient', ModelFilter::class, [
                 'field_type' => ModelAutocompleteType::class,
                 'field_options' => ['property'=>'username'],
            ])
            ->add('type');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')
            ->add('type')
            ->add('object', null, ['label' => 'Object'])
            ->add('sender')
            ->add('recipient')
            ->add('createdAt')
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => []]]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')
            ->add('type')
            ->add('object')
            ->add('sender')
            ->add('recipient')
            ->add('createdAt')
            ->add('message', null, ['label' => 'Message', 'safe' => true]);
    }
}