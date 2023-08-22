<?php
return [
    'tokens' => [
        '0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE' => [
            'coingeckoId' => 'ethereum',
            'name' => 'ETH'
        ],
        '0xE405de8F52ba7559f9df3C368500B6E6ae6Cee49' => [
            'coingeckoId' => 'seth',
            'name' => 'sETH'
        ],
        '0x8c6f28f2F1A3C87F0f938b96d27520d9751ec8d9' => [
            'coingeckoId' => 'nusd',
            'name' => 'sUSD'
        ],
        '0xc40F949F8a4e094D1b49a23ea9241D289B7b2819' => [
            'coingeckoId' => 'liquity-usd',
            'name' => 'lUSD'
        ],
        '0xae7ab96520DE3A18E5e111B5EaAb095312D7fE84' => [
            'coingeckoId' => 'staked-ether',
            'name' => 'stETH'
        ],
        '0x4e3FBD56CD56c3e72c1403e103b45Db9da5B9D2B' => [
            'coingeckoId' => 'convex-finance',
            'name' => 'CVX'
        ],
        '0x1F32b1c2345538c0c6f582fCB022739c4A194Ebb' => [
            'coingeckoId' => 'wrapped-steth',
            'name' => 'wstETH'
        ],
        '0x4200000000000000000000000000000000000006' => [
            'coingeckoId' => 'weth',
            'name' => 'wETH'
        ],
        '0x62B9c7356A2Dc64a1969e19C23e4f579F9810Aa7' => [
            'coingeckoId' => 'convex-crv',
            'name' => 'cvxCRV'
        ],
        '0xFEEf77d3f69374f66429C91d732A244f074bdf74' => [
            'coingeckoId' => 'frax-share',
            'name' => 'cvxFXS'
        ],
        '0x5A98FcBEA516Cf06857215779Fd812CA3beF1B32' => [
            'coingeckoId' => 'lido-dao',
            'name' => 'LDO'
        ],
        '0xFdb794692724153d1488CcdBE0C56c252596735F' => [
            'coingeckoId' => 'lido-dao',
            'name' => 'LDO (OP)'
        ],
        '0x4200000000000000000000000000000000000042' => [
            'coingeckoId' => 'optimism',
            'name' => 'OP'
        ],
        'bitcoin' => [
            'coingeckoId' => 'bitcoin',
            'name' => 'BTC'
        ],
        '0xe405de8f52ba7559f9df3c368500b6e6ae6cee49' => [
            'coingeckoId' => 'seth',
            'name' => 'sETH'
        ],
        '0x912ce59144191c1204e64559fe8253a0e49e6548' => [
            'coingeckoId' => 'arbitrum',
            'name' => 'ARB'
        ],
        '0x8aE125E8653821E851F12A49F7765db9a9ce7384' => [
            'coingeckoId' => 'dola-usd',
            'name' => 'DOLA'
        ],
        '0x7F5c764cBc14f9669B88837ca1490cCa17c31607' => [
            'coingeckoId' => 'usd-coin',
            'name' => 'USDC'
        ]
    ],
    'contracts' => [
        'arbitrum' => [
            [
                'address' => '0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE',
                'type' => 'Ethereum',
                'name' => 'ETH (Arbitrum)'
            ],
            [
                'address' => '0x912ce59144191c1204e64559fe8253a0e49e6548',
                'type' => 'Token',
                'name' => 'ARB'
            ]
        ],
        'optimism' => [
            [
                'address' => '0xFdb794692724153d1488CcdBE0C56c252596735F',
                'type' => 'Token',
                'name' => 'LDO (Optimism)'
            ],
            [
                'address' => '0x4200000000000000000000000000000000000042',
                'type' => 'Token',
                'name' => 'OP'
            ],
            [
                'address' => '0x1F32b1c2345538c0c6f582fCB022739c4A194Ebb',
                'type' => 'Token',
                'name' => 'wstETH'
            ],
            [
                'address' => '0x453f61390ce6DfB668bbF4D93E58c94BB0ae81f3',
                'type' => 'BeefyPool',
                'name' => 'DOLA/USDC',
                'stable' => true
            ]
        ],
        'mainnet' => [
            [
                'address' => '0xEeeeeEeeeEeEeeEeEeEeeEEEeeeeEeeeeeeeEEeE',
                'type' => 'Ethereum',
                'name' => 'ETH (Mainnet)'
            ],
            [
                'address' => '0x4e3FBD56CD56c3e72c1403e103b45Db9da5B9D2B',
                'type' => 'Token',
                'name' => 'CVX'
            ],
            [
                'address' => '0xb5b29320d2dde5ba5bafa1ebcd270052070483ec',
                'type' => 'Sommelier',
                'name' => 'RealYield ETH'
            ],
            [
                'address' => '0x0A760466E1B4621579a82a39CB56Dda2F4E70f03',
                'type' => 'ConvexPool',
                'name' => 'stETH/ETH'
            ],
            [
                'address' => '0x83507cc8c8b67ed48badd1f59f684d5d02884c81',
                'type' => 'CvxCrvPounderPool',
                'name' => 'cvxCRV Pounder'
            ]
        ]
    ]
];

