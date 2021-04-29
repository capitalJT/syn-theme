const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const VueLoaderPlugin = require('vue-loader/lib/plugin')
const webpack = require('webpack')
const path = require('path')

const isProd = process.env.NODE_ENV === 'production'

module.exports = {
    mode: process.env.NODE_ENV || 'development',
    entry: ['babel-polyfill', 'string.prototype.includes', './src/main'],
    output: {
        path: path.resolve(__dirname, './static'),
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    'css-loader?url=false'
                ]
            },
            {
                test: /\.scss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader
                    },
                    'css-loader?url=false',
                    'sass-loader'
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        scss: [
                            'vue-style-loader',
                            'css-loader?url=false',
                            'sass-loader'
                        ]
                    },
                    extractCSS: true,
                    postcss: [
                        require('autoprefixer')({
                            browsers: ['last 5 versions']
                        })
                    ]
                }
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules\/(?!(clamp-js|vue-three-wrap|regenerator-runtime)\/).*/
            }
        ]
    },
    optimization: {
        minimize: isProd
    },
    resolve: {
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '~': path.resolve(__dirname, './')
        },
        extensions: ['*', '.js', '.vue', '.json']
    },
    devtool: '#source-map',
    plugins: [
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            path: path.resolve(__dirname, './static'),
            filename: 'bundle.css'
        }),
        new webpack.ProvidePlugin({
            _get: ['lodash/get']
        })
    ]
}

if (isProd) {
    module.exports.devtool = 'source-map'
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.LoaderOptionsPlugin({
            minimize: true
        })
    ])
}
