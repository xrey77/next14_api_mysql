import { PrismaClient } from "@prisma/client";
import speakeasy from'speakeasy';

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);

    try {
        const user = await prisma.user.findUnique({
          where: {
            id: req.id,
          },
        })

        if (!user?.id) {
          return { message: 'Use ID not found.' };
        }

        // let secretCode = speakeasy.generateSecret({length: 20});

        let tokenCode = req.otpcode;
        let secretCode = user.secretkey;
        let verified = speakeasy.totp.verify({
          secret: secretCode,
          encoding: 'base32',
          token: tokenCode,
          window: 6
        })
        if (verified) {
            return { statuscode: 200,message: 'Validation Successfull.', username: user.username};
        } else {
            return { statuscode: 404,message: 'Invalid OTP Code.'};
        }

    } catch(e: any) {
        return { statuscode: 404, message: e.message};
    }



});
