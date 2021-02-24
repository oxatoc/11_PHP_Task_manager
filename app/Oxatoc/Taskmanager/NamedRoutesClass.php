<?php

namespace Oxatoc\Taskmanager;

/**
 * Названия маршрутов
 */

class NamedRoutesClass{
    const login = '/auth/login';
    const authStore = '/auth/store';
    const logout = '/auth/logout';
    
    const create = '/tasks/create';
    const index = '/tasks/index';
    const store = '/tasks/store';
    const setSort = '/tasks/setsort';
    const complete = '/tasks/complete';
    const edit = '/tasks/edit';
    const update = '/tasks/update';

}