<?php

namespace App\Controller\Admin;

use App\Entity\PriseDeVue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;  
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;  
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PriseDeVueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PriseDeVue::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('ecole', 'École'),
            AssociationField::new('photographe', 'Photographe'),
            AssociationField::new('theme', 'Thème'),
            AssociationField::new('typeDePrise', 'Type de prise'),
            AssociationField::new('typeVente', 'Type de vente'),
            AssociationField::new('pochette', 'Pochette'),
            DateTimeField::new('datePriseVue', 'Date de prise de vue'),
            NumberField::new('nbEleve', 'Nombre d\'élèves'),
            NumberField::new('nbClasse', 'Nombre de classes'),
            NumberField::new('prixParent', 'Prix parents'),
            NumberField::new('prixEcole', 'Prix école'),
            TextareaField::new('commentaires')->hideOnIndex(),
            DateTimeField::new('createdAt', 'Créé le')->hideOnForm(),
            DateTimeField::new('updatedAt','Modifié le')->hideOnForm(),
            //IdField::new('id')->hideOnForm(),
        ];
    }
}
