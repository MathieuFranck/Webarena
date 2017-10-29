<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\ArenasController;
use App\Controller\EventsController;

/**
 * Fighters Controller
 *
 * @property \App\Model\Table\FightersTable $Fighters
 *
 * @method \App\Model\Entity\Fighter[] paginate($object = null, array $settings = [])
 */
class FightersController extends AppController
{
    /**
     * @var instance of Event Controller
     */
    protected $eventsController;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->eventsController = new EventsController();
    }

    /**
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function listFighters() {
        $fighters = $this->Fighters->loadFightersPlayer($this->Auth->user('id'));
        $this->set('fighters', $fighters);
        $this->set('_serialize', ['fighter']);
    }

    /**
     * View method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fighter = $this->Fighters->get($id, [
            'contain' => ['Players', 'Guilds', 'Messages', 'Tools']
        ]);

        $player = $this->loadModel('Players')->get($this->Auth->user('id'));

        $this->set(compact('fighter', 'player'));
        $this->set('_serialize', ['fighter']);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fighter = $this->Fighters->newEntity();
        if ($this->request->is('post')) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            $fighter->current_health = 5;
            $fighter->level = 1;
            $fighter->xp = 1;
            $fighter->skill_strength = 1;
            $fighter->skill_health = 5;
            $fighter->skill_sight = 2;
            do {
                $x = rand(0, 14);
                $y = rand(0, 9);
            }while(!$this->Fighters->isPositionFree($x, $y));
            $fighter->coordinate_x = $x;
            $fighter->coordinate_y = $y;
            $fighter->player_id = $this->Auth->user('id');
            if ($this->Fighters->save($fighter)) {
                move_uploaded_file($this->request->getData()['avatar_file']['tmp_name'], WWW_ROOT.'\img\avatars'.DS.$this->Auth->user('id').'_'.$fighter->id.'.jpg');
                $this->eventsController->add($fighter->name." arrive sur l'arène!", $fighter->coordinate_x, $fighter->coordinate_y);
                $this->Flash->success(__('The fighter has been saved.'));
                return $this->redirect(['action' => 'view/'.$fighter->id]);
            }
            $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
        }
        $players = $this->Fighters->Players->find('list', ['limit' => 200]);
        $guilds = $this->Fighters->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('fighter', 'players', 'guilds'));
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($id == null)
            $this->redirect([
                'controller' => 'Fighters',
                'action' => 'listFighters',
            ]);

        $fighter = $this->Fighters->get($id, [
            'contain' => ['Players', 'Guilds', 'Messages', 'Tools']
        ]);

        if($fighter->player->id != $this->Auth->user('id'))
        {
            $this->Flash->error(__('Access denied'));
            $this->redirect([
                'controller' => 'Fighters',
                'action' => 'view/'.$id,
            ]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
        }

        $players = $this->Fighters->Players->find('list', ['limit' => 200]);
        $guilds = $this->Fighters->Guilds->find('list', ['limit' => 200]);
        $this->set(compact('fighter', 'players', 'guilds'));
        $this->set('_serialize', ['fighter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fighter = $this->Fighters->get($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Save the avatar of the fighter
     *
     * @param \App\Model\Entity\Fighter $fighter
     * @param string $imageName
     */
    public function saveAvatar($fighter, $imageName) {
        return debug(WWW_ROOT);
        move_uploaded_file($imageName, WWW_ROOT.'webarena/webroot/img/avatars'.DS.$this->Auth->user('id').'_'.$fighter->id.'jpg');
    }
}
