<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Admin Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Admin', 'icon' => 'user', 'url' => ['/admin']],
                    ['label' => 'Posts', 'icon' => 'list', 'url' => ['/posts']],
                    ['label' => 'Users', 'icon' => 'users', 'url' => ['/user']],
                    ['label' => 'Banks', 'icon' => 'bank', 'url' => ['/banks']],
                    ['label' => 'Checkout', 'icon' => 'arrow-right', 'url' => ['/checkouts']],
                    ['label' => 'withdrawal', 'icon' => 'bank', 'url' => ['/withdrawal-requests']],
                    ['label' => 'Wallet-Histories', 'icon' => 'history', 'url' => ['/wallet-histories']],
                    ['label' => 'notification', 'icon' => 'bell', 'url' => ['/notification']],



                ],
            ]
        ) ?>

    </section>

</aside>
