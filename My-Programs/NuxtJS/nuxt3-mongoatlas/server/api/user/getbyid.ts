import { PrismaClient } from "@prisma/client";
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const query = getQuery(event);

    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);
    try {
        const result = await jwt.verify(token, config.public.secret);
        const user = await prisma.user.findUnique({
            where: {
                id: query.id?.toString()
            }
        })
        return user;
        
    } catch(e: any) {
        return { statuscode: 403, message: "Un-Authorized Access."};
    }

});