const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
    content: ['./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],
    plugins: [
      require('tw-elements/dist/plugin')
    ]
  }

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],


    plugins: [
        require('daisyui'),
      ],

      daisyui: {
        styled: true,
        themes: true,
        base: true,
        utils: true,
        logs: true,
        rtl: false,
      },
      
};



