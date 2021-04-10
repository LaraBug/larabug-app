const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
    },
    purge: [
        './resources/views/**/*.blade.php',
        './resources/assets/js/frontend/**/*.js',
    ],
    theme: {
        typography: {
            default: {
                css: {
                    a: {
                        color: '#D22651',
                        '&:hover': {
                            color: '#BD2249',
                        },
                    },
                },
            },
        },
        minWidth: {
            '0': '0',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
            '12': '12rem'
        },
        extend: {
            colors: {
                'primary': {
                    100: '#FBE9EE',
                    200: '#F4C9D4',
                    300: '#EDA8B9',
                    400: '#E06785',
                    500: '#D22651',
                    600: '#BD2249',
                    700: '#7E1731',
                    800: '#5F1124',
                    900: '#3F0B18',
                },
                'orange': {
                    100: '#FEF2EB',
                    200: '#FCDECE',
                    300: '#F9C9B0',
                    400: '#F5A175',
                    500: '#F1793A',
                    600: '#D96D34',
                    700: '#914923',
                    800: '#6C361A',
                    900: '#482411',
                },
                'green': {
                    100: '#EBF9EB',
                    200: '#CDEFCD',
                    300: '#AEE5AF',
                    400: '#72D274',
                    500: '#35BE38',
                    600: '#30AB32',
                    700: '#207222',
                    800: '#185619',
                    900: '#103911',
                },
            },
            fontFamily: {
                sans: [
                    'Rubik',
                    'Cerebri Sans',
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            boxShadow: theme => ({
                'outline': '0 0 0 2px ' + theme('colors.indigo.500'),
            }),
            fill: theme => theme('colors'),
        },
    },
    variants: {
        fill: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        zIndex: ['responsive', 'focus'],
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/typography'),
    ],
}
