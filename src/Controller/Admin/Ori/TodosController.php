<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Todos Controller
 *
 * @property \App\Model\Table\TodosTable $Todos
 */
class TodosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Todos->find()
            ->contain(['Users']);
        $todos = $this->paginate($query);

        $this->set(compact('todos'));
    }

    /**
     * View method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $todo = $this->Todos->get($id, contain: ['Users']);
        $this->set(compact('todo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $todo = $this->Todos->newEmptyEntity();
        if ($this->request->is('post')) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', limit: 200)->all();
        $this->set(compact('todo', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $todo = $this->Todos->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $todo = $this->Todos->patchEntity($todo, $this->request->getData());
            if ($this->Todos->save($todo)) {
                $this->Flash->success(__('The todo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The todo could not be saved. Please, try again.'));
        }
        $users = $this->Todos->Users->find('list', limit: 200)->all();
        $this->set(compact('todo', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Todo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $todo = $this->Todos->get($id);
        if ($this->Todos->delete($todo)) {
            $this->Flash->success(__('The todo has been deleted.'));
        } else {
            $this->Flash->error(__('The todo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
