import { PrismaClient } from "@prisma/client";
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {    
    const prisma = new PrismaClient();
    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);

    try {

      const result = await jwt.verify(token, config.public.secret);
      try {
          const users = await prisma.user.findMany();
          return {users};
      } catch(e: any) {
          return {statuscode: 404, message: e.message};
      }

    } catch(e) {
      return { statuscode: 403, message: "Un-Authorized Access."};
    }




});