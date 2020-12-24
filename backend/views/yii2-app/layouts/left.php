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
                    ['label' => 'Banks', 'icon' => 'bank', 'url' => ['/bank-list']],
                    ['label' => 'Post Checkout', 'icon' => 'arrow-right', 'url' => ['/checkouts']],

                    ['label' => 'Balance withdrawal', 'icon' => 'bank', 'url' => ['/withdrawal-requests']],
                    ['label' => 'Wallet-Histories', 'icon' => 'history', 'url' => ['/wallet-histories']],
                    ['label' => 'Notification', 'icon' => 'bell', 'url' => ['/notification']],
                    ['label' => 'Verification', 'icon' => 'thumbs-up', 'url' => ['/verifications']],
                    ['label' => 'Referrer-code', 'icon' => 'connectdevelop', 'url' => ['/referrer-code']],
                    [
                        'label' => 'Blog',
                        'icon' => 'list',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Posts', 'icon' => 'arrow-right', 'url' => ['/blog-post'],],
                            ['label' => 'Categories', 'icon' => 'arrow-right', 'url' => ['/category'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
