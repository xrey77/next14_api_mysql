import { PrismaClient } from "@prisma/client";
import { readFiles } from 'h3-formidable';
import fs from 'fs';
import path from 'path';
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const params = getQuery(event);

    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);

    try {
      const result = await jwt.verify(token, config.public.secret);

      const { files: { myImage: [ { filepath, mimetype } ] } } = await readFiles(event, {
          includeFields: true
      });
      let imageName = params.id;
      let newPath = `${path.join("public", "users", imageName)}.${ mimetype.split('/')[1] }`;
      let ext = path.extname(newPath);

      let urlimg = "/users/"+ imageName + ext;
      fs.copyFileSync(filepath, newPath);

      await prisma.user.update({
        where: {
            id: params.id
        },
        data: {
            profilepic: urlimg
        }
      });
      return { statuscode: 200, message: "Profile picture has been changed.", profilepic: urlimg }
    } catch(e) {
      return { statuscode: 401, message: "Unauthorized Access." }
    }
});
