<?php

return [
    [
        'label' => 'Overview',
        'items' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'home'],
        ],
    ],
    [
        'label' => 'Website content',
        'items' => [
            ['label' => 'Services', 'route' => 'admin.section', 'params' => ['section' => 'services'], 'icon' => 'grid'],
            ['label' => 'Programs & training', 'route' => 'admin.section', 'params' => ['section' => 'programs'], 'icon' => 'book'],
            ['label' => 'Team members', 'route' => 'admin.section', 'params' => ['section' => 'team'], 'icon' => 'people'],
            ['label' => 'Resources', 'route' => 'admin.section', 'params' => ['section' => 'resources'], 'icon' => 'document'],
            ['label' => 'Case studies', 'route' => 'admin.section', 'params' => ['section' => 'case-studies'], 'icon' => 'growth'],
            ['label' => 'FAQs', 'route' => 'admin.section', 'params' => ['section' => 'faqs'], 'icon' => 'chat'],
        ],
    ],
    [
        'label' => 'Inbox',
        'items' => [
            ['label' => 'Consultation requests', 'route' => 'admin.section', 'params' => ['section' => 'consultations'], 'icon' => 'compass'],
            ['label' => 'Contact messages', 'route' => 'admin.section', 'params' => ['section' => 'messages'], 'icon' => 'chat'],
        ],
    ],
    [
        'label' => 'Configuration',
        'items' => [
            ['label' => 'Site settings', 'route' => 'admin.section', 'params' => ['section' => 'settings'], 'icon' => 'technology'],
        ],
    ],
];
