module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: [
    './resources/assets/js/panel/**/*.vue',
    './resources/assets/js/panel/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: 'Inter',
      },
      boxShadow: {
        'focus': '0 0 0 3px rgba(164, 202, 254, 0.45)',
        'form-focus-primary': '0 0 0 1px #266EBC',
        'form-focus-danger': '0 0 0 1px #e02424',
      },
      colors: {
        primary: {
          50: '#F4F8FC',
          100: '#E9F1F8',
          200: '#C9DBEE',
          300: '#A8C5E4',
          400: '#679AD0',
          500: '#266EBC',
          600: '#2263A9',
          700: '#174271',
          800: '#113255',
          900: '#0B2138',
        },
      },
    },
  },
  variants: {
    boxShadow: ['focus', 'hover', 'focus-within'],
  },
  plugins: [require('@tailwindcss/ui')],
}
