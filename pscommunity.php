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
        $this->author = 'PrestaCommunity';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Community Wall of Fame');
        $this->description = $this->l('Displays top GitHub contributors.');
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
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminPsCommunity';
        $tab->name = [];
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = 'Community';
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('IMPROVE');
        $tab->module = $this->name;

        return $tab->add();
    }

    private function unregisterTab()
    {
        $idTab = (int) Tab::getIdFromClassName('AdminPsCommunity');
        if ($idTab) {
            $tab = new Tab($idTab);
            return $tab->delete();
        }
        return true;
    }
}
