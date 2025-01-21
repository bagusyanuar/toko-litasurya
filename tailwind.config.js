const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                spinner: {
                    '100%': {transform: 'rotate(360deg)'},
                },
            },
            animation: {
                spinner: 'spinner 1.5s linear infinite',
            },
            boxShadow: {
                'sidebar': '3px 0 3px -2px rgba(0, 0, 0, 0.2)',
                'top-navigation': '0 3px 3px -2px rgba(0, 0, 0, 0.2)',
            },
            width: {
                'sidebar': '270px',
            },
            colors: {
                'background': '#F7F7F7',
                // 'brand': {
                //     50: '#eff1fc',
                //     100: '#cdd3f7',
                //     200: '#b5bef3',
                //     300: '#93a1ed',
                //     400: '#7e8ee9',
                //     500: '#5e72e4',
                //     600: '#5668cf',
                //     700: '#4351a2',
                //     800: '#343f7d',
                //     900: '#273060',
                // },
                'brand': {
                    50: '#e6f5f2',
                    100: '#cceae5',
                    200: '#99d5cb',
                    300: '#66c0b1',
                    400: '#33ab97',
                    500: '#004540',
                    600: '#007362',
                    700: '#00504a',
                    800: '#003735',
                    900: '#00241f'
                },
                'neutral': {
                    50: '#fafafa',
                    100: '#f5f5f5',
                    200: '#e4e4e7',
                    300: '#d4d4d8',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
                'primary': {
                    50: '#eff6ff',
                    100: '#e0f2fe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
                'danger': {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                },
                'success': {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534',
                    900: '#14532d',
                },
                'warning': {
                    50: '#fefce8',
                    100: '#fef9c3',
                    200: '#fef08a',
                    300: '#fde047',
                    400: '#facc15',
                    500: '#eab308',
                    600: '#ca8a04',
                    700: '#a16207',
                    800: '#854d0e',
                    900: '#713f12',
                }
            }
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        "./node_modules/flowbite/**/*.js",
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin')
    ],
}
