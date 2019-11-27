<?php

/**
 * -------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module UserService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
 */
class UserService extends BaseService {

    public function getUserGroupList($orderField='userg_id', $orderBy='ASC') {

        $q = Doctrine_Query::create()
                        ->from('UserGroup')
                        ->orderBy($orderField . ' ' . $orderBy);

        $userGroupList = $q->execute();

        return $userGroupList;
    }

    public function saveUserGroup(UserGroup $userGroup) {

        $q = Doctrine_Query::create()
                        ->from('UserGroup u')
                        ->where('u.userg_name = ?', $userGroup->userg_name);

        if (!empty($userGroup->userg_id)) {
            $q->andWhere('u.userg_id <> ?', $userGroup->userg_id);
        }

        $count = $q->count();

        if ($count > 0) {
            throw new DuplicateNameException();
        }

        if ($userGroup->getUsergId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($userGroup);
            $userGroup->setUsergId($idGenService->getNextID());
        }
        $userGroup->save();

        return $userGroup;
    }

    public function deleteUserGroup($userGroupList) {

        if (is_array($userGroupList)) {
            $q = Doctrine_Query::create()
                            ->delete('UserGroup')
                            ->whereIn('userg_id', $userGroupList);
            $numDeleted = $q->execute();

            return true;
        }
    }

    public function searchUserGroup($searchMode, $searchValue) {

        $searchValue = trim($searchValue);
        $q = Doctrine_Query::create( )
                        ->from('UserGroup')
                        ->where("$searchMode = ?", $searchValue);


        $userGroupList = $q->execute();

        return $userGroupList;
    }

    public function readUserGroup($id) {

        $userGroup = Doctrine::getTable('UserGroup')->find($id);
        return $userGroup;
    }

    public function getCapabilityList() {

        $q = Doctrine_Query::create()
                        ->from('capability c');
        return $q->execute();
    }

    public function saveUser(Users $user) {

        if ($user->getId() == '') {
            $idGenService = new IDGeneratorService();
            $idGenService->setEntity($user);
            $user->setId($idGenService->getNextID());
        }

        $user->save();
    }

    public function isExistingUser($userName) {


        $q = Doctrine_Query::create( )
                        ->from('Users u')
                        ->where("u.user_name='$userName'");


        return ($q->count() > 0) ? true : false;
    }

    public function isAlreadyAssign($userName) {


        $q = Doctrine_Query::create( )
                        ->from('Users u')
                        ->where("u.emp_number='$userName'");


        return ($q->count() > 0) ? true : false;
    }

    public function deleteUser($userList) {


        $q = Doctrine_Query::create()
                        ->delete('Users')
                        ->whereIn('id', $userList);


        $numDeleted = $q->execute();
    }

    public function readUser($id) {

        $user = Doctrine::getTable('Users')->find($id);
        return $user;
    }

    public function getModuleList(UserGroup $userGrop) {

        $existingModule = array();
        $existingModules = $this->getUserGroupModelRights($userGrop);
        foreach ($existingModules as $right) {
            array_push($existingModule, "'" . $right->getModule()->getModId() . "'");
        }

        $q = Doctrine_Query::create()
                        ->from('Module m');

        if (count($existingModules) > 0) {
            $q->where("m.mod_id NOT IN (" . implode(',', $existingModule) . ")");
        }
        $q->orderBy('mod_id ASC');

        $moduleList = $q->execute();

        return $moduleList;
    }

    public function deleteUserGroupModelRights(UserGroup $userGrop) {

        $q = Doctrine_Query::create()
                        ->delete('ModuleRights')
                        ->where("userg_id='" . $userGrop->getUsergId() . "'");


        $numDeleted = $q->execute();
    }

    public function getSecurityLevel() {

        $q = Doctrine_Query::create()
                        ->from('CompanyStructureLevels c');
        return $q->execute();
    }

    public function getUserDefLevel($id) {
        $q = Doctrine_Query::create()
                        ->select('def_level')
                        ->from('CompanyStructure')
                        ->where('id= ?', $id);

        return $q->fetchArray();
    }

}