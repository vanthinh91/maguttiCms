<?php

namespace App\maguttiCms\Domain\Admin;

use App\Role;
use Illuminate\Support\Facades\Auth;
use App\AdminUser;

/**
 * Trait AdminAcl
 * @package App\maguttiCms\Domain\Admin
 */
trait AdminAcl
{
    /*
    |--------------------------------------------------------------------------
    | SIMPLE ACL ROLE
    |--------------------------------------------------------------------------
    |
    */


    /**
     * GF_ma gestione semplice delle sezioni
     * in base hai ruoli
     * @param $section
     * @return bool
     */
    public function canViewSection($section)
    {
        if (!isset($section['roles'])) {
            return true;
        }
        if ($this->hasRole($section['roles'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return int
     */
    public function isSu()
    {
        return Auth::guard('admin')->user()->hasRole(['su']);
    }

    /**
     * GF_ma utenti con ruolo
     * su or  admin
     * @return int
     */
    public function isAdmin()
    {
        return Auth::guard('admin')->user()->hasRole(['su', 'admin']);
    }

    /**
     *
     * GF_ma semplice gestione assegnazione ruoli
     * solo admin e su possono asegnare
     * i ruoli agli utenti del cms
     * @return int
     */
    public function hideEditRole()
    {
        return !$this->isAdmin();
    }

    /**
     *
     * GF_ma gestione funzionalità
     * di delete per ruolo
     * @return int
     */
    public function canDelete()
    {
        return Auth::guard('admin')->user()->hasRole(['su', 'admin']);
    }

    /**
     * level utente piu basso più strong
     * @return mixed
     */
    public function getLevel()
    {
        return $this->roles()->min('level');
    }

    /* verifico che utente non possa salvare 
     *  un livello piu basso del suo
     */

    public function saveRolesAbility($roles)
    {
        if($this->isSu()) return true ;
        else {
            $level = Auth::guard('admin')->user()->getLevel();
            return (!Role::find($roles)->where('level','<',$level)->first()) ? true : false;
        }
    }
}