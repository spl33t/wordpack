const path = require('path')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const CopyPlugin = require("copy-webpack-plugin")


module.exports = {
    context: path.resolve(__dirname, 'assets'), //Директория с исходниками *
    mode: 'development',
    entry: {
        main: './js/index.js', //Путь основной JS
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
    plugins: [
        new CleanWebpackPlugin(),
        new MiniCssExtractPlugin()
    ],
    module: {
        rules: [
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
        ],
    },
}