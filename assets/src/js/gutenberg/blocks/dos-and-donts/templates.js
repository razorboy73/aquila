
const getBlockColumn = (optionVal, colClassName, heading ) => {
    return[
        'core/column',
        {className: colClassName},
        [
            [
                'aquila-blocks/heading',
                {
                    className: 'aquila-dos-and-donts__heading',
                    option: optionVal,
                    content: heading
                }
            ],
            [
                'core/list',
                {
                     className: 'aquila-dos-and-donts__list'
                }
            ]
        ]
    ]
}

export const blockColumns =         [
    [
        'core/columns',
        {
        className:'aquila-dos-and-donts__cols',
        },
        [
            getBlockColumn('dos','aquila-dos-and-donts__cols-one','Dos'),
            getBlockColumn('donts','aquila-dos-and-donts__cols-two',"Dont's"),
        ],
    ],
];
