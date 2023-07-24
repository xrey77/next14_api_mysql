import { Nitro } from 'nitropack'

export default async (_nitroApp: Nitro) => {
//  const config = useRuntimeConfig();
 try {
//    await mongoose.connect(config.mongodbUri,  {
//      useUntifiedTopology: true,
//   });
   console.log("Connected to MongoDB Server");
 } catch(e: any) {
     console.error(e.message);
 }
}