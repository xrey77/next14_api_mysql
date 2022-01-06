import express from 'express';
const app = express()
import path from 'path';
const PORT : string|number = process.env.PORT || 5000;
import routes from './routes/UserRoutes';
import bodyParser from 'body-parser';

app.use(bodyParser.urlencoded({
    extended: true
  }));

//USING STATIC FILES
app.use(express.static('src/assets'));

//USING PUG TEMPLATE
app.set('view engine', 'pug');
app.set('views', [path.join(__dirname, 'views')]);

//USING FORMS REQUEST
app.use(express.json({limit: '10mb'}));
app.use(express.urlencoded({
  extended: true,
  limit:'10mb'
}));

//INTEGRATE ROUTER
app.use(routes);

app.listen(PORT,() => console.log(`hosting @${PORT}`));

// createConnection({
//     type: "postgres",
//     host: process.env.TYPEORM_HOST,
//     port: Number(process.env.TYPEORM_PORT),
//     username: process.env.TYPEORM_USERNAME,
//     password: process.env.TYPEORM_PASSWORD,
//     database: process.env.TYPEORM_DATABASE,
//     extra: {
//       ssl: true,
//     },
//     entities: [ User ],

// }).then(async (connection) => {
//     console.log("connected postgresql database...");
// }).catch(error => console.log(error));
