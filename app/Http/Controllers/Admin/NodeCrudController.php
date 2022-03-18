<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NodeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NodeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NodeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Node::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/node');
        CRUD::setEntityNameStrings('node', '節點管理');
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
        CRUD::addColumn([
            'name' => 'country',
            'type' => 'text',
            'label' => '國家'
        ]);
        CRUD::addColumn([
            'name' => 'region',
            'type' => 'text',
            'label' => '地區'
        ]);
        CRUD::addColumn([
            'name' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        ]);
        CRUD::addColumn([
            'name' => 'hostname',
            'type' => 'text',
            'label' => '機器名稱'
        ]);
        CRUD::addColumn([
            'name' => 'hostname',
            'type' => 'text',
            'label' => '機器名稱'
        ]);
        CRUD::addColumn([
            'name' => 'connection',
            'type' => 'boolean',
            'label' => '連線狀況'
        ]);
        CRUD::addColumn([
            'name' => 'monitor',
            'type' => 'boolean',
            'label' => '監控'
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
        CRUD::setValidation(NodeRequest::class);

        CRUD::addField([
            'name' => 'group',
            'type' => 'text',
            'label' => '群組'
        ]);
        CRUD::addField([
            'name' => 'country',
            'type' => 'text',
            'label' => '國家'
        ]);
        CRUD::addField([
            'name' => 'region',
            'type' => 'text',
            'label' => '地區'
        ]);
        CRUD::addField([
            'name' => 'ip',
            'type' => 'text',
            'label' => 'IP'
        ]);
        CRUD::addField([
            'name' => 'hostname',
            'type' => 'text',
            'label' => '機器名稱'
        ]);
        CRUD::addField([
            'name' => 'hostname',
            'type' => 'text',
            'label' => '機器名稱'
        ]);
        CRUD::addField([
            'name' => 'connection',
            'type' => 'boolean',
            'label' => '連線狀況'
        ]);
        CRUD::addField([
            'name' => 'monitor',
            'type' => 'boolean',
            'label' => '監控'
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
}
