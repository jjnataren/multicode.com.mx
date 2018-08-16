<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CatalogoEvento */

$this->title = 'Create Catalogo Evento';
$this->params['breadcrumbs'][] = ['label' => 'Catalogo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-evento-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
