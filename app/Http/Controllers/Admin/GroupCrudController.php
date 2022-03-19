<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \App\Http\Controllers\Operations\BulkCloneOperation;
    use \App\Http\Controllers\Operations\BulkDeleteOperation;
    use \App\Http\Controllers\Operations\CloneOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Group::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/group');
        CRUD::setEntityNameStrings('群組', '群組管理');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::addColumn([
            'name' => 'group',
            'type' => 'text',
            'label' => '群組'
        ]);
        // TODO: datatable can't search for relationship column.
        CRUD::addColumn([
            'name'   => 'user',
            'type'   => 'relationship',
            'label'  => '帳號',
            'entity' => 'user',
            'attribute' => 'email'
        ]);
        CRUD::addColumn([
            'name' => 'status',
            'type' => 'boolean',
            'label' => '狀態',
            'options' => [0 => '停用', 1 => '啟用'], // optional
            'wrapper' => [
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['value'] == 1) {
                        return 'text-success';
                    }
                    return 'text-danger';
                },
            ],
        ]);
        CRUD::addColumn([
            'name' => 'created_at',
            'type' => 'datetime',
            'label' => '建立時間',
        ]);
        CRUD::addColumn([
            'name' => 'updated_at',
            'type' => 'datetime',
            'label' => '更新時間',
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GroupRequest::class);
        CRUD::addField([
            'name' => 'group',
            'type' => 'text',
            'label' => '群組'
        ]);
        CRUD::addField([
            'type' => 'select',
            'label' => '帳號',
            'name' => 'user_id',    // the db column for the foreign key

            // optional - manually specify the related model and attribute
            // 'model'     => "App\Models\User", // related model
            'entity'    => 'user',  // 'entity' should point to the method that defines the relationship in your Model
            'attribute' => 'email', // foreign key attribute that is shown to user

            // optional - force the related options to be a custom query, instead of all();
            'options'   => (function ($query) {
                return $query->orderBy('email', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        CRUD::addField([
            'name' => 'status',
            'type' => 'checkbox',
            'label' => '狀態(勾選啟用群組)',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}
