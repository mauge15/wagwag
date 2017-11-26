<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/usuariopuppy.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Administrador</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                 ['label' => 'MENU PRINCIPAL', 'options' => ['class' => 'header']],
                 [
                    'label' => 'Clientes',
                    'icon' => 'user-circle-o',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Nuevo', 'icon' => 'plus-square', 'url' => ['/propietario/create'],],
                        ['label' => 'Gestionar', 'icon' => 'dashboard', 'url' => ['/propietario'],],
                     ],
                 ],

				  [
	                    'label' => 'Mascotas',
	                    'icon' => 'paw',
	                    'url' => '#',
	                    'items' => [
	                        ['label' => 'Nuevo', 'icon' => 'plus-square', 'url' => ['/mascota/create'],],
	                        ['label' => 'Gestionar', 'icon' => 'dashboard', 'url' => ['/mascota'],],
	                     ],
	                 ],

			
                    ['label' => 'Asistencia', 'icon' => 'calendar', 'url' => ['/debug']],

                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                ],
            ]
        ) ?>

    </section>

</aside>