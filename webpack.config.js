const path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const TerserPlugin = require("terser-webpack-plugin")
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin')

const isDev = process.env.NODE_ENV === 'development' //Проверка является ли сборка DEV
const isProd = !isDev

const optimization = () => {
    const config = {
        splitChunks: {
            //chunks: 'all' //Разбить файлы по частям
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
        filename: '[name].js', //Название конечного JS
        path: path.resolve(__dirname, 'dist') //Путь конечной директории
    },
    resolve: {
        alias: {
            '@css': path.resolve(__dirname, 'assets/css'), //Директория CSS
            '@js': path.resolve(__dirname, 'assets/js'), //Директория JS
        }
    },
    optimization: optimization(),
    plugins: [
        
        // Создаем svg-спрайт с иконками
        new SVGSpritemapPlugin(
            'assets/img/icons/*.svg', // Путь относительно каталога с webpack.mix.js
            {
                output: {
                    filename: 'icons.svg', // Путь относительно каталога public/
                    svg4everybody: true, // Отключаем плагин "SVG for Everybody"
                    svg: {
                        sizes: false // Удаляем инлайновые размеры svg
                    },
                    chunk: {
                        keep: true, // Включаем, чтобы при сборке не было ошибок из-за отсутствия spritemap.js
                    },
                },
                sprite: {
                    prefix: 'icon-', // Префикс для id иконок в спрайте, будет иметь вид 'icon-имя_файла_с_иконкой'
                    generate: {
                        title: false, // Не добавляем в спрайт теги <title>
                    },
                },
            }
        ),
    

        new MiniCssExtractPlugin(),
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
                use: [MiniCssExtractPlugin.loader, 'css-loader',
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
                }, 'sass-loader',
                ]
            },
            {
                //FONTS loader
                test: /\.(ttf|woff|woff2|eot)$/,
                use: ['file-loader']
            },
            {
                //IMG loader
                test: /\.(png|jpg|svg|gif)$/,
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