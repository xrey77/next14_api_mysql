import { PrismaClient } from "@prisma/client";
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);
    const { query } = req;

    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);

    try {
        const result = await jwt.verify(token, config.public.secret);
        try {
            const user = await prisma.user.delete({
                where: {
                    id: query.id || ''
                }
            })
            return {statuscode: 200, message: "User ID has been deleted."};
        } catch(e) {
            return {statuscode: 400, message: "User Id not found."};
        }
        
    } catch(e) {
        return {statuscode: 401, message: "Unauthorized Access."};
    }

});