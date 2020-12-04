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
                    ['label' => 'withdrawal Request', 'icon' => 'cc-mastercard', 'url' => ['/withdrawal-requests']],
                    ['label' => 'Wallet Histories', 'icon' => 'history', 'url' => ['/wallet-histories']],
                    ['label' => 'Notification', 'icon' => 'bell', 'url' => ['/notification']],
                    ['label' => 'Referrer-code', 'icon' => 'connectdevelop', 'url' => ['/referrer-code']],



                ],
            ]
        ) ?>

    </section>

</aside>
