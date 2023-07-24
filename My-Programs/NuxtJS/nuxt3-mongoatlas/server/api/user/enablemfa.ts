import { PrismaClient } from "@prisma/client";
import speakeasy from 'speakeasy';
import QRCode from "qrcode";
import jwt from 'jsonwebtoken';
const config = useRuntimeConfig();

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const query = getQuery(event);
    const req = await readBody(event);

    const auth = getRequestHeaders(event);
    let token = auth.authorization?.slice(7);

    try {
        const result = await jwt.verify(token, config.public.secret);

        let isenabled: any = req.isenabled;
        let fullname: any = "HONDA INC. (" + req.fullname + " )";
        const secret =speakeasy.generateSecret({
            name: fullname, length: 2
        });

        // let secretCode = speakeasy.generateSecret({length: 20});


        QRCode.toDataURL(secret.otpauth_url || '', async function(err: any,data: any) {

            await prisma.user.update({
                where: {
                    id: req.id.toString()
                },
                data: {
                    secretkey: isenabled ? secret.base32 : '',
                    qrcodeurl: isenabled ? data : '',
                }
            });

        });

        if (isenabled) {
            return {statuscode: 200, message: "2-Factor Authentication is enabled, please refresh then click checkbox again ang scan QRCODE."};
        } else {
            return {statuscode: 200, message: "2-Factor Authentication has been disabled"};
        }

    } catch(e: any) {
        return {statuscode: 401, message: 'Unauthorized Access.'};
    }

});
