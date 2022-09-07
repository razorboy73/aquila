//get path to the file
//remember to install path

const path = require("path");
console.log("const path:", path);
//create a directory variable
//gets path to the src directory
//const HtmlWebPackPlugin = require('html-webpack-plugin') //added to run dev server

//need a loader to render css into javascript
//remember to add rules to modules section
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

//CleanWebpackPlugin removes unused webpack assets on rebuild
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const cssnano = require("cssnano");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const CopyPlugin = require('copy-webpack-plugin'); // https://webpack.js.org/plugins/copy-webpack-plugin/

//Externalize dependencies that are available as script dependencies on modern
//WordPress sites.  Add an asset file for each entry point that declares an object
//with the list of WordPress script dependencies for the entry point. The asset file
//also contains the current version calculated for the current source code.
//This allows JavaScript bundles produced by webpack to leverage WordPress style
//dependency sharing without an error-prone process of manually maintaining a
//dependency list.

const DependencyExtractionWebpackPlugin = require("@wordpress/dependency-extraction-webpack-plugin");

//Paths
const JS_DIR = path.resolve(__filename, "../src/js");
// Image directory
const IMG_DIR = path.resolve(__filename, "../src/img");
// Library directory
const LIB_DIR = path.resolve(__filename, "../src/library");
//Build Directory
const BUILD_DIR = path.resolve(__filename, "../build");

const entry = {
  main: JS_DIR + "/main.js",
  single: JS_DIR + "/single.js",
  editor: JS_DIR + "/editor.js",
  blocks: JS_DIR + "/blocks.js",
  author: JS_DIR + "/author.js"
};

//allows entry to take the root of the path defined in context
//'./src/index.js', - typical default
//use an object if there are more than one file
// where do you want to bundle the files
// will take file name from the entry file
const output = {
  path: BUILD_DIR,
  filename: "js/[name].js",
};

const rules = [
  {
    test: /\.js$/,
    include: [JS_DIR],
    exclude: /node_modules/,
    use: "babel-loader",
  },
  {
    test: /\.scss$/,
    exclude: /node_modules/,
    use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
  },
  {
    test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
    use: {
      loader: "file-loader",
      options: {
        name: "[path][name].[ext]",
        publicPath: "production" === process.env.NODE_ENV ? "../" : "../../",
      },
    },
  },
  {
    test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
    exclude: [IMG_DIR, /node_modules/],
    use: {
      loader: "file-loader",
      options: {
        name: "[path][name].[ext]",
        publicPath: "production" === process.env.NODE_ENV ? "../" : "../../",
      },
    },
  },
];

const plugins = (argv) => [
  new CleanWebpackPlugin({
    //returns true in production
    cleanStaleWebpackAssets: "production" === argv.mode,
  }),
  new MiniCssExtractPlugin({
    //extract it to the file below
    filename: "css/[name].css",
  }),
  new CopyPlugin( {
		patterns: [
			{ from: LIB_DIR, to: BUILD_DIR + '/library' }
		]
	} ),
  new DependencyExtractionWebpackPlugin({
    injectPolyfill: true,
    /*
        combineAssets
            Type: boolean Default: false
            By default, one asset file is created for each entry point. When this flag is set to 
            true, all information about assets is combined into a single assets.(json|php) 
            file generated in the output directory.
        */
    combineAssets: true,
  }),
];

module.exports = (env, argv) => ({
  entry: entry,
  output: output,
  devtool: "source-map",
  module: {
    rules: rules,
  },
  optimization: {
    minimizer: [
      new CssMinimizerPlugin({
        //cssProcessor:cssnano,
      }),
      new UglifyJsPlugin({
        cache: false,
        parallel: true,
        sourceMap: false,
      }),
    ],
  },
  plugins: plugins(argv),
  externals: {
    jquery: "jQuery",
  },
});
