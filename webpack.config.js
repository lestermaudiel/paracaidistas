const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app': './src/js/app.js',
    'js/inicio': './src/js/inicio.js',
    'js/tiposparacaidas/index': './src/js/tiposparacaidas/index.js',
    'js/tiposalto/index': './src/js/tiposalto/index.js',
    'js/zonasalto/index': './src/js/zonasalto/index.js',
    'js/altimetro/index': './src/js/altimetro/index.js',
    'js/pista/index': './src/js/pista/index.js',
    'js/aeronave/index': './src/js/aeronave/index.js',
    'js/civil/index': './src/js/civil/index.js',
    'js/paracaidas/index': './src/js/paracaidas/index.js',
    'js/manifiesto/index': './src/js/manifiesto/index.js',
    'js/paracaidista/index': './src/js/paracaidista/index.js',

  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          },
          'css-loader',
          'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
          name: 'img/[name].[hash:7].[ext]'
        }
      },
    ]
  }
};