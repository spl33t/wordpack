const path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const CopyPlugin = require("copy-webpack-plugin")
const TerserPlugin = require("terser-webpack-plugin")
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')

const isDev = process.env.NODE_ENV === 'development' //Проверка является ли сборка DEV
const isProd = !isDev

const optimization = () => {
    const config = {
        splitChunks: {
            //Не подключать одни и теже библиотеки два раза
            chunks: 'all'
        },
    }
    if (isProd) {
        config.minimizer = [
            new OptimizeCssAssetsPlugin(),
            new TerserPlugin()
        ]
    }

    return config
}

module.exports = {
    context: path.resolve(__dirname, 'assets'), //Директория с исходниками *
    mode: 'development',
    entry: {
        main: './index.js', //Путь основной JS
    },
    output: {
        filename: 'main.js', //Название конечного JS
        path: path.resolve(__dirname, 'dist') //Путь конечной директории
    },
    resolve: {
        alias: {
            '@css': path.resolve(__dirname, 'assets/css'), //Директория CSS
            '@js': path.resolve(__dirname, 'assets/js') //Директория JS
        }
    },
    optimization: optimization(),
    plugins: [
        new MiniCssExtractPlugin()
    ],
    module: {
        rules: [
            {
                //CSS loader
                test: /\.css$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader']
            },
            {
                //SAS loader
                test: /\.s[ac]ss$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader',
                {
                    loader: "postcss-loader",
                    options: {
                        postcssOptions: {
                            plugins: [
                                [
                                    "postcss-preset-env",
                                    {
                                        // Options
                                    },
                                ],
                            ],
                        },
                    },
                },
                ]
            },
            {
                //FONTS loader
                test: /\.(ttf|wof|wof2|eot)$/,
                use: ['file-loader']
            },
            {
                //BABEL Обработчик JS
                test: /\.m?js$/,
                exclude: /node_modules/, //Не обрабатывать папку node_
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            }
        ],
    },
}