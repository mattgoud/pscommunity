<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class PsCommunity extends Module
{
    public function __construct()
    {
        $this->name = 'pscommunity';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Prestashop SA';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Wall of Fame');
        $this->description = $this->l('Displays and highlights contributors to the PrestaShop open source project');
    }

    public function install()
    {
        return parent::install()
            && $this->registerTab();
    }

    public function uninstall()
    {
        return parent::uninstall()
            && $this->unregisterTab();
    }

private function registerTab()
{
    $parentTab = new Tab();
    $parentTab->active = 1;
    $parentTab->class_name = 'AdminPsCommunityParent';
    $parentTab->id_parent = 0;
    $parentTab->module = $this->name;
    foreach (Language::getLanguages() as $lang) {
        $parentTab->name[$lang['id_lang']] = $this->l('Community');
    }
    $parentTab->add();

    $childTab = new Tab();
    $childTab->active = 1;
    $childTab->class_name = 'AdminPsCommunityTopContributors';
    $childTab->id_parent = (int) Tab::getIdFromClassName('AdminPsCommunityParent');
    if (property_exists($childTab, 'route_name')) {
        $childTab->route_name = 'pscommunity_top_contributors';
    }
    $childTab->module = $this->name;
    foreach (Language::getLanguages() as $lang) {
        $childTab->name[$lang['id_lang']] = $this->l('Top Contributors');
    }
    $childTab->add();

    return true;
}


    private function unregisterTab()
    {
        $idChildTab = (int) Tab::getIdFromClassName('AdminPsCommunityTopContributors');
        if ($idChildTab) {
            $tab = new Tab($idChildTab);
            $tab->delete();
        }
        $idParentTab = (int) Tab::getIdFromClassName('AdminPsCommunityParent');
        if ($idParentTab) {
            $tab = new Tab($idParentTab);
            $tab->delete();
        }
        return true;
    }
}
