const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: 'class', // false or 'media' or 'class'
  theme: {
    extend: {
        fontFamily: {
            'inter': ['Inter', ...defaultTheme.fontFamily.sans],
        },
        fontSize: {
            '2xs': ['0.625rem', '0.75rem'],
        },
        zIndex: {
            '-10': '-10',
        },
    },
  },
  variants: {
    extend: {
        backgroundColor: ['checked', 'hover', 'active'],
        ringColor: ['checked', 'hover', 'active'],
        ringWidth: ['checked', 'hover', 'active'],
        borderWidth: ['checked', 'hover', 'focus'],
        borderColor: ['checked', 'hover', 'focus'],
    },
  },
  plugins: [],
}
