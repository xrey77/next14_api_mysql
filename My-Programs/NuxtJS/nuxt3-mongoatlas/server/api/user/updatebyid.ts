import { PrismaClient } from "@prisma/client";
import bcrypt from "bcryptjs";
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);
    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);

    try {
        const result = await jwt.verify(token, config.public.secret);

          if (req.password !== '') {

            try {
                await prisma.user.update({
                    where: {
                        id: req.id
                    },
                    data: {
                        lastname: req.lastname,
                        firstname: req.firstname,
                        mobile: req.mobile,
                        password: bcrypt.hashSync(req.password, 10)
                    }
                });
                return {statuscode: 200, message: "User password has been changed."};

            } catch(e) {
                return {statuscode: 404, message: "User ID not found."};
            }

          } else {

            try{
                await prisma.user.update({
                    where: {
                        id: req.body.id,
                    },
                    data: {
                        lastname: req.lastname,
                        firstname: req.firstname,
                        mobile: req.mobile
                    }
                })
                return {statuscode: 200, message: "Profile has been updated successfully."};
            } catch(e) {
                return {statuscode: 404, message: "User ID not found."};
            }
        }

    } catch(e) {
        return {statuscode: 401, message: "Unauthorized Access."};
    }
});
