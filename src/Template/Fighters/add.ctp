<div class="container-fluid">
    <div class="row mt-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Create your Fighter ! 
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($fighter) ?>
                    <fieldset>
                        <?= $this->Form->control('name',['class'=>'form-control']) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>